<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Create an admin
    User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'city' => 'City A',
        'sex' => 'Male',
        'address' => 'Address 123',
    ]);

    // Create a teacher
    $teacherUser = User::create([
        'name' => 'Teacher One',
        'email' => 'teacher@example.com',
        'password' => bcrypt('password'),
        'role' => 'teacher',
        'city' => 'City B',
        'sex' => 'Female',
        'address' => 'Address 456',
    ]);

    // Add subject to teacher
    Teacher::create([
        'user_id' => $teacherUser->id,
        'subject' => 'Math',
    ]);

    // Create a student
    $studentUser = User::create([
        'name' => 'Student One',
        'email' => 'student@example.com',
        'password' => bcrypt('password'),
        'role' => 'student',
        'city' => 'City C',
        'sex' => 'Male',
        'address' => 'Address 789',
        'level' => 3,
    ]);
}
}