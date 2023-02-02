<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            ['name' => 'Registrar'],
            ['name' => 'Dean'],
            ['name' => 'President'],
            ['name' => 'MSO'],
        ];

        foreach ($offices as $key => $value) {
            Office::create($value);
        }
    }
}
