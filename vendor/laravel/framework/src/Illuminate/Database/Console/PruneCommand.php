<?php

namespace Illuminate\Database\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class PruneCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'model:prune
                                {--model=* : Class names of the models to be pruned}
                                {--chunk=1000 : The number of models to retrieve per chunk of models to be deleted}
                                {--pretend : Display the number of prunable records found instead of deleting them}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune models that are no longer needed';

    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function handle(Dispatcher $events)
    {
        $models = $this->models();

        if ($models->isEmpty()) {
            $this->info('No prunable models found.');

            return;
        }

        if ($this->option('pretend')) {
            $models->each(function ($model) {
                $this->pretendToPrune($model);
            });

            return;
        }

        $events->listen(ModelsPruned::class, function ($event) {
            $this->info("{$event->count} [{$event->model}] records have been pruned.");
        });

        $models->each(function ($model) {
            $instance = new $model;

            $chunkSize = property_exists($instance, 'prunableChunkSize')
                            ? $instance->prunableChunkSize
                            : $this->option('chunk');

            $total = $this->isPrunable($model)
                        ? $instance->pruneAll($chunkSize)
                        : 0;

            if ($total == 0) {
                $this->info("No prunable [$model] records found.");
            }
        });

        $events->forget(ModelsPruned::class);
    }

    /**
     * Determine the models that should be pruned.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function models()
    {
        if (! empty($models = $this->option('model'))) {
            return collect($models);
        }

        return collect((new Finder)->in(app_path('Models'))->files()->name('*.php'))
            ->map(function ($model) {
                $namespace = $this->laravel->getNamespace();

                return $namespace.str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($model->getRealPath(), realpath(app_path()).DIRECTORY_SEPARATOR)
                );
            })->filter(function ($model) {
                return $this->isPrunable($model);
            })->values();
    }

    /**
     * Determine if the given model class is prunable.
     *
     * @param  string  $model
     * @return bool
     */
    protected function isPrunable($model)
    {
        $uses = class_uses_recursive($model);

        return in_array(Prunable::class, $uses) || in_array(MassPrunable::class, $uses);
    }

    /**
     * Display how many models will be pruned.
     *
     * @param  string  $model
     * @return void
     */
    protected function pretendToPrune($model)
    {
        $instance = new $model;

        $count = $instance->prunable()
            ->when(in_array(SoftDeletes::class, class_uses_recursive(get_class($instance))), function ($query) {
                $query->withTrashed();
            })->count();

        if ($count === 0) {
            $this->info("No prunable [$model] records found.");
        } else {
            $this->info("{$count} [{$model}] records will be pruned.");
        }
    }
}
