<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name' => 'BCP'],
            ['name' => 'INTERBANK'],
        ];

        DB::table('banks')->insert($banks);
    }
}
