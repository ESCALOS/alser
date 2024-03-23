<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Price;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory([
            'name' => 'Carlos Escate',
            'email' => 'stornblood6969@gmail.com',
            'is_admin' => true,
        ])->create();
        Price::factory(10)->create();

        $this->call([
            FaqSeeder::class,
            LocationDepartmentSeeder::class,
            LocationProvinceSeeder::class,
            LocationDistrictSeeder::class,
        ]);
    }
}
