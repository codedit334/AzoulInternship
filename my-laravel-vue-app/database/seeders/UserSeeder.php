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
        DB::table('users')->insert([
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'role' => 'admin'],
            ['name' => 'Teacher User', 'email' => 'teacher@example.com', 'password' => bcrypt('password'), 'role' => 'teacher'],
            ['name' => 'Student User', 'email' => 'student@example.com', 'password' => bcrypt('password'), 'role' => 'student'],
        ]);
    }
}