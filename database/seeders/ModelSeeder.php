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
            'Apple' => [
                'iPhone 15 Pro Max', 'iPhone 15 Pro', 'iPhone 15 Plus', 'iPhone 15',
                'iPhone 14 Pro Max', 'iPhone 14 Pro', 'iPhone 14 Plus', 'iPhone 14',
                'iPhone 13 Pro Max', 'iPhone 13 Pro', 'iPhone 13 mini', 'iPhone 13',
                'iPhone 12 Pro Max', 'iPhone 12 Pro', 'iPhone 12 mini', 'iPhone 12',
                'iPhone 11 Pro Max', 'iPhone 11 Pro', 'iPhone 11',
                'iPhone SE (3rd generation)', 'iPhone SE (2nd generation)',
                'iPhone XS Max', 'iPhone XS', 'iPhone XR', 'iPhone X',
                'iPhone 8 Plus', 'iPhone 8', 'iPhone 7 Plus', 'iPhone 7',
                'iPhone 6s Plus', 'iPhone 6s', 'iPhone 6 Plus', 'iPhone 6', 'iPhone 5s', 'iPhone 5', 'iPhone 4', 'iPhone 3g',

                'iPad Pro 12.9-inch (6th generation)', 'iPad Pro 11-inch (4th generation)',
                'iPad Air (5th generation)', 'iPad Air (4th generation)',
                'iPad (10th generation)', 'iPad (9th generation)',
                'iPad mini (6th generation)', 'iPad mini (5th generation)',

                'Apple Watch Ultra 2', 'Apple Watch Ultra',
                'Apple Watch Series 9', 'Apple Watch Series 8',
                'Apple Watch SE (2nd generation)', 'Apple Watch SE (1st generation)',

                'AirPods Max', 'AirPods Pro (2nd generation)', 'AirPods Pro (1st generation)',
                'AirPods (3rd generation)', 'AirPods (2nd generation)',

                'Apple Pencil (USB-C)', 'Apple Pencil (2nd generation)', 'Apple Pencil (1st generation)',
                'Magic Keyboard', 'Magic Mouse', 'Magic Trackpad'
            ]
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
