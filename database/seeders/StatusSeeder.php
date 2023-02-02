<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name' => 'Pending'],
            ['name' => 'Admin Received'],
            ['name' => 'Forwarded to office'],
            ['name' => 'Office Received'],
            ['name' => 'Employee Received'],
            ['name' => 'Completed'],
            ['name' => 'Rejected'],
            ['name' => 'Reply'],
        ];

        foreach ($status as $key => $value) {
            Status::create($value);
        }
    }
}
