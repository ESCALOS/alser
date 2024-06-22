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
            [
                'name' => 'BCP',
                'sol_account_name' => 'Banco de Crédito del Perú corriente Soles',
                'sol_account_number' => '781289123891327',
                'dollar_account_name' => 'Banco de Crédito del Perú corriente Dólares',
                'dollar_account_number' => '89018912387123',
            ],
            [
                'name' => 'INTERBANK',
                'sol_account_name' => 'Interbank corriente Soles',
                'sol_account_number' => '12898188812312',
                'dollar_account_name' => 'Interbank corriente Dólares',
                'dollar_account_number' => '45878128819',
            ],
        ];

        DB::table('banks')->insert($banks);
    }
}
