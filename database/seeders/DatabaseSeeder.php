<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(BrandSeeder::class);
        $this->call(ModelSeeder::class);

        User::factory()->create([
            'name' => 'Albert',
            'email' => 'alberthaciverdiyev55@gmail.com',
            'password' => Hash::make('albert'),
        ]);
    }
}
