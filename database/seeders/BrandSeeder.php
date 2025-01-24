<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Huawei'],
            ['name' => 'Xiaomi'],
            ['name' => 'Google'],
            ['name' => 'Sony'],
            ['name' => 'LG'],
            ['name' => 'Nokia'],
            ['name' => 'Motorola'],
            ['name' => 'OnePlus'],
            ['name' => 'Oppo'],
            ['name' => 'Realme'],
            ['name' => 'Asus'],
            ['name' => 'HTC'],
            ['name' => 'Lenovo'],
            ['name' => 'ZTE'],
            ['name' => 'Vivo'],
            ['name' => 'Alcatel'],
            ['name' => 'Meizu'],
            ['name' => 'Sharp'],
        ]);
    }
}
