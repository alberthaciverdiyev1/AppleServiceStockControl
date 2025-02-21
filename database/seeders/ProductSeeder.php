<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = DB::table('product_models')->get();
        $parts = DB::table('parts')->get();

        foreach ($models as $model) {
            foreach ($parts as $part) {
                if (DB::table('products')->where('model_id', $model->id)
                    ->where('part_id', $part->id)
                    ->exists()) {
                    continue;
                }

                DB::table('products')->insert([
                    'model_id' => $model->id,
                    'part_id' => $part->id,
                    'buying_price' => 0,
                    'selling_price' => 0,
                ]);
            }
        }

    }
}
