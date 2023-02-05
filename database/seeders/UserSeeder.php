<?php

namespace Database\Seeders;

use App\Models\ClientType;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'ARTA',
            'last_name' => 'HEAD',
            'email' => 'arta-head@gmail.com',
            'password' => Hash::make('artahead12345'),
            'role' => Role::ADMIN,
            'email_verified_at' => Carbon::now(),
        ]);
        $admin->types()->attach(ClientType::ADMIN);

        $office = User::create([
            'first_name' => 'OFFICE',
            'last_name' => 'MANAGER',
            'email' => 'office-manager@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => Role::OFFICE,
            'email_verified_at' => Carbon::now(),
        ]);
        $office->types()->attach(ClientType::OFFICE);

        $student = User::create([
            'first_name' => 'STUDENT',
            'last_name' => 'MAIN',
            'email' => 'student-main@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => Role::CLIENT,
            'email_verified_at' => Carbon::now(),
        ]);
        $student->types()->attach([ClientType::STUDENT, ClientType::PARENT]);
    }
}
