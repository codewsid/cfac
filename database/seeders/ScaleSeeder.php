<?php

namespace Database\Seeders;

use App\Models\Scale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scales = [
            [
                'scale_title' => 'Job Knowledge',
                'value' => 4,
            ],
            [
                'scale_title' => 'Fast Service',
                'value' => 5,
            ],
        ];

        foreach ($scales as $key => $value) {
            Scale::create($value);
        }
    }
}
