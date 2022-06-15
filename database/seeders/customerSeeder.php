<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Customer;

class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('customers')->insert(
    //         [
    //             [
    //                 'name' => 'Myrwen Dingal',
    //                 'contactNo' => '0985155',
    //                 'address' => 'CDO, Bukidnon', 
    //             ],
    //             [
    //                 'name' => 'Robert',
    //                 'contactNo' => '02323656',
    //                 'address' => 'Negros Occidental', 
    //             ]
    //         ]
    //             );
    // }
        public function run(){
            // factory(Customer::class, 6)->create();
            \App\Models\Customer::factory()->count(15)->create();

    }
}
