<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = [
            [
                'name' => 'Job Knowledge',
            ],
            [
                'name' => 'Good and Clean Office/Unit',
            ],
            [
                'name' => 'Respectable Employee',
            ],
            [
                'name' => 'Good Service',
            ],
            [
                'name' => 'Fast Service',
            ],
        ];

        foreach ($criteria as $key => $value) {
            Criteria::create($value);
        }
    }
}
