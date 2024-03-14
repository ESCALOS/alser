<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Amazonas'],
            ['name' => 'Áncash'],
            ['name' => 'Apurímac'],
            ['name' => 'Arequipa'],
            ['name' => 'Ayacucho'],
            ['name' => 'Cajamarca'],
            ['name' => 'Callao'],
            ['name' => 'Cusco'],
            ['name' => 'Huancavelica'],
            ['name' => 'Huánuco'],
            ['name' => 'Ica'],
            ['name' => 'Junín'],
            ['name' => 'La Libertad'],
            ['name' => 'Lambayeque'],
            ['name' => 'Lima'],
            ['name' => 'Loreto'],
            ['name' => 'Madre de Dios'],
            ['name' => 'Moquegua'],
            ['name' => 'Pasco'],
            ['name' => 'Piura'],
            ['name' => 'Puno'],
            ['name' => 'San Martín'],
            ['name' => 'Tacna'],
            ['name' => 'Tumbes'],
            ['name' => 'Ucayali'],
        ];

        DB::table('location_departments')->insert($departments);
    }
}
