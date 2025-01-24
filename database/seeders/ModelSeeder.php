<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'Apple' => ['iPhone 14', 'iPhone 13', 'iPhone 12'],
            'Samsung' => ['Galaxy S23', 'Galaxy S22', 'Galaxy Note 20'],
            'Huawei' => ['P50', 'P40', 'Mate 40'],
            'Xiaomi' => ['Mi 11', 'Redmi Note 11', 'Poco F3'],
            'Google' => ['Pixel 7', 'Pixel 6', 'Pixel 5'],
            'Sony' => ['Xperia 1 III', 'Xperia 5 II', 'Xperia 10 III'],
            'LG' => ['V60 ThinQ', 'G8X ThinQ', 'Velvet'],
            'Nokia' => ['Nokia 8.3', 'Nokia 5.4', 'Nokia 3.4'],
            'Motorola' => ['Edge 20', 'Moto G Power', 'Moto G Stylus'],
            'OnePlus' => ['OnePlus 9', 'OnePlus 8', 'OnePlus Nord'],
            'Oppo' => ['Find X5', 'Reno 7', 'A95'],
            'Realme' => ['Realme GT 2', 'Realme 9 Pro', 'Realme 8 Pro'],
            'Asus' => ['ZenFone 9', 'ZenFone 8', 'ROG Phone 5'],
            'HTC' => ['U12+', 'Desire 20 Pro', 'Wildfire E2'],
            'Lenovo' => ['Legion Phone Duel', 'K12 Note', 'Z6 Pro'],
            'ZTE' => ['Axon 20 5G', 'Blade V2020', 'Axon 10 Pro'],
            'Vivo' => ['V21 5G', 'V15 Pro', 'X60 Pro'],
            'Alcatel' => ['Alcatel 3X', 'Alcatel 1S', 'Alcatel 1V'],
            'Meizu' => ['Meizu 18', 'Meizu 17', 'Meizu 16T'],
            'Sharp' => ['Aquos R6', 'Aquos Sense 5G', 'Aquos Zero 5G'],
        ];

        foreach ($models as $brandName => $modelNames) {
            $brandId = DB::table('brands')->where('name', $brandName)->first()->id;

            foreach ($modelNames as $modelName) {
                DB::table('product_models')->insert([
                    'name' => $modelName,
                    'brand_id' => $brandId,
                ]);
            }
        }
    }
}
