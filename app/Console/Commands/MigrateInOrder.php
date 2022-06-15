<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $migrations = [ 
            '2014_10_12_000000_create_users_table.php',
            '2014_10_12_100000_create_password_resets_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2019_12_09_044534_create_roles_table.php',
            '2019_12_09_082630_create_role_user_table.php',
            '2019_12_09_094511_create_social_accounts_table.php',
            '2019_12_27_065818_create_products_table.php',
            '2019_12_27_070549_create_categories_table.php',
            '2019_12_27_070603_create_tags_table.php',
            '2020_01_08_113508_create_product_tag_pivot_table.php',
            '2021_09_22_135852__create_customers_table.php',
            '2021_09_22_135853_create_invoices_table.php',
            '2021_09_27_050112_create_purchase_details_table.php',
            '2022_03_08_102340_create_invoiceimages_table.php',
            '2022_02_01_030308_create_serials_table.php', 

        ];

        foreach($migrations as $migration)
            {
                $basePath = 'database/migrations/';          
                $migrationName = trim($migration);
                $path = $basePath.$migrationName;
                $this->call('migrate:refresh', [
                '--path' => $path ,            
            ]);
        }

        return Command::SUCCESS;
    }
}
