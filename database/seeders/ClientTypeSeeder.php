<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientType::create(['name' => 'Admin']);
        ClientType::create(['name' => 'Office']);
        ClientType::create(['name' => 'Alumni']);
        ClientType::create(['name' => 'Employee']);
        ClientType::create(['name' => 'Parent']);
        ClientType::create(['name' => 'Student']);
        ClientType::create(['name' => 'Visitor']);
    }
}
