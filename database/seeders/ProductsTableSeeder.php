<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert(
            [
                [   
                    // 'sku' => '0000001',
                    'name' => 'MSI B11M-092LA i3-11th gen',
                    'description' => 'MSI Modern 14 B11M-092LA Premium Ultrabook Intel i3-1115G4/8GB/512GB NVMe SSD/Intel UHD Graphics Xe G4 48 Eus/Win10 Laptop Carbon Gray',
                    // 'price' => rand(1000000, 100000000),
                    'price' => 37995,
                    'category_id' => 1,
                    'photo' => 'images/cars/cima_1912_top_01.jpg.ximg.l_full_m.smart.jpg',
                    'stocks' => 6,
                    'criticalLevel' => 2,
                    // 'serialno' => 654321001,
                    'sold' => 0
                ],
                [   
                    // 'sku' => '0000002',
                    'name' => 'Acer Helios 300 i7-10870H',
                    'description' => 'Acer Helios 300 PH315-53-76WP Gaming Laptop i7-10870H 16gb/512 SSD/RTX 3070/15.6" FHD IPS/Win10 Home/Bag/Brand New Acer Helios i7 Gaming Laptop with 16gb RAM, RTX 3070, SSD, Best for Gaming, Autocad and Work/11BRI.',
                    'price' => 117995,
                    'category_id' => 2,
                    'photo' => 'images/cars/fuga_1912_top_02 . jpg . ximg . l_full_m . smart . jpg',
                    'stocks' => 5,
                    'criticalLevel' => 1,
                    // 'serialno' => 654321002,
                    'sold' => 0
                ],
                [   
                    // 'sku' => '0000003',
                    'name' => 'Dell Inspiron 5405',
                    'description' => 'Dell Inspiron 5405 Ryzen 5-4500U 8gb/256 SSD/UMA/14"/Win 10/Office Home Silver Laptop',
                    'price' => 37500,
                    'category_id' => 1,
                    'photo' => 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg',
                    'stocks' => 4,
                    'criticalLevel' => 1,
                    // 'serialno' => 654321002,
                    'sold' => 0
                ],
                [   
                    // 'sku' => '0000004',
                    'name' => 'Chuwi Mijabook',
                    'description' => 'Chuwi Mijabook Laptop Intel Celeron N3450 8gb/256 SSD/13"/WIN10 Home',
                    'price' => 13725,
                    'category_id' => 1,
                    'photo' => 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg',
                    'stocks' => 5,
                    'criticalLevel' => 1,
                    // 'serialno' => 654321003,
                    'sold' => 0
                ],
                [   
                    // 'sku' => '0000005',
                    'name' => 'Acer Nitro 5',
                    'description' => 'Acer Nitro 5 AN515-44-R7ZUR5-4600H 8Gb/256 SSD/GTX 1650/15.6"/WIN10 Home Gaming Laptop',
                    'price' => 38995,
                    'category_id' => 1,
                    'photo' => 'images/cars/teana_1803_top_002.jpg.ximg.l_full_m.smart.jpg',
                    'stocks' => 6,
                    'criticalLevel' => 2,
                    // 'serialno' => 654321007,
                    'sold' => 0
                ],
                [   
                    // 'sku' => '0000006',
                    'name' => 'HP PAVILION i5-1135G7',
                    'description' => 'HP PAVILION 14-DV0062TX/DV0063TX Laptop i5-1135G7 8gb/512 SSD/14" FHD IPS/MX 450/Win10 Home/Tranquil Pink/Warm Gold 1ION',
                    'price' => 42995,
                    'category_id' => 2,
                    'photo' => 'images/cars/panel01_img01.jpg',
                    'stocks' => 5,
                    'criticalLevel' => 2,
                    // 'serialno' => 654321004,
                    'sold' => 0
                ],
                [   
                    // 'sku' => '0000007',
                    'name' => 'Huawei MateBook D15 Amd Ryzen 7',
                    'description' => 'Huawei MateBook D15 Amd Ryzen 7 3700U/8gb/512gb SSD/Rx Vega 10/15.6" IPS/Win10 Laptop+Value Plus',
                    'price' => 36995,
                    'category_id' => 3,
                    'photo' => 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg',
                    'stocks' => 4,
                    'criticalLevel' => 1,
                    // 'serialno' => 654321006,
                    'sold' => 0
                ],
            ]
        );
    }
}
