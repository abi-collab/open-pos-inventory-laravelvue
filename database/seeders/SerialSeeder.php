<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SerialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('serials')->insert(
            [
                [   
                    'ssku' => '1',
                    'serialnumber' => '10001',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => ''
                ],
                [   
                    'ssku' => '2',
                    'serialnumber' => '20002',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => ''   
                ],
                [   
                    'ssku' => '4',
                    'serialnumber' => '40004',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '3',
                    'serialnumber' => '30003',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '1',
                    'serialnumber' => '1000444',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '2',
                    'serialnumber' => '200089',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '5',
                    'serialnumber' => '5000555',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '1',
                    'serialnumber' => '1000000',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '1',
                    'serialnumber' => '1000111',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '5',
                    'serialnumber' => '56789',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '4',
                    'serialnumber' => '444444',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '5',
                    'serialnumber' => '555555',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '7',
                    'serialnumber' => '70001',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '7',
                    'serialnumber' => '70002',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '7',
                    'serialnumber' => '70003',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null,
                    'imageid' => '' 
                ],
                [   
                    'ssku' => '7',
                    'serialnumber' => '70004',
                    'petsa' => Carbon::now()->timezone('Asia/Manila'),
                    'orderno' => null,
                    'orderdate' => null,
                    'returnno' => null,
                    'remarks' => '',
                    'customerid' => null ,
                    'imageid' => ''
                ],
            ]
            );
    }
}
