<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Livewire\Admin\Criteria;
use App\Models\ClientType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientTypeSeeder::class,
            FeedbackTypeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CriteriaSeeder::class,
            ScaleSeeder::class,
            OfficeSeeder::class,
            StatusSeeder::class,

            EmployeeSeeder::class,
        ]);
    }
}
