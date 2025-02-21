<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = DB::table('product_models')->get();
        $brands = DB::table('brands')->get();
        $parts = [
            'Kamera',
            'Ekran',
            'Batareya',
            'Şarj Girişi',
            'Dinamik',
            'Mikrofon',
            'Titrəmə Motoru',
            'Face ID Modulu',
            'Wi-Fi/Bluetooth Modulu',
            'UWB Çipi',
            'Simisiz Şarj Bobini',
            'Sensor',
            'Çərçivə',
            'SIM Kart Yuvası',
            'Power Düyməsi',
            'Səs Kontrol Düymələri',
            'Səssiz Rejim Düyməsi'
        ];

        foreach ($models as $model) {
            foreach ($parts as $part) {
                foreach ($brands as $brand) {
                    DB::table('parts')->insert([
                        'name' => $part,
                        'model_id' => $model->id,
                        'brand_id' => $brand->id,
                    ]);
                }
            }
        }
    }
}
