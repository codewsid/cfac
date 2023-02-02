<?php

namespace Database\Seeders;

use App\Models\FeedbackType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeedbackType::create(['name' => 'Complaint']);
        FeedbackType::create(['name' => 'Compliment']);
        FeedbackType::create(['name' => 'Suggestion']);
    }
}
