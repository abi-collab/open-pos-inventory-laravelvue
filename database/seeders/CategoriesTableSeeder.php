<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert(
            [
                [
                    'name' => 'Laptop',
                    'description' => Str::words(50),
                    'warranty' => 30
                ],
                [
                    'name' => 'Desktop Package',
                    'description' => Str::words(50),
                    'warranty' => 25
                ],
                [
                    'name' => 'Computer Peripheral',
                    'description' => Str::words(50),
                    'warranty' => 7
                ]
                // [
                //     'name' => 'Minivan',
                //     'description' => Str::words(50),
                // ],
                // [
                //     'name' => 'Sports & Specialty',
                //     'description' => Str::words(50),
                // ],
                // [
                //     'name' => 'Sedan',
                //     'description' => Str::words(50),
                // ],
            ]
        );
    }
}
