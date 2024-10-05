<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some teachers
        $teacher1 = User::create([
            'name' => 'Teacher One',
            'email' => 'teacher1@example.com',
            'password' => bcrypt('password'), // Use bcrypt for hashing the password
            'role' => 'teacher',
            'teacher_id' => null, // Teachers don't have a teacher_id
        ]);

        $teacher2 = User::create([
            'name' => 'Teacher Two',
            'email' => 'teacher2@example.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'teacher_id' => null,
        ]);

        // Create some students and associate them with teachers
        User::create([
            'name' => 'Student One',
            'email' => 'student1@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'teacher_id' => $teacher1->id, // Associate with Teacher One
        ]);

        User::create([
            'name' => 'Student Two',
            'email' => 'student2@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'teacher_id' => $teacher1->id, // Associate with Teacher One
        ]);

        User::create([
            'name' => 'Student Three',
            'email' => 'student3@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'teacher_id' => $teacher2->id, // Associate with Teacher Two
        ]);

        User::create([
            'name' => 'Student Four',
            'email' => 'student4@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'teacher_id' => $teacher2->id, // Associate with Teacher Two
        ]);

        $school1 = School::create(['name' => 'School A', 'address' => '123 Main St']);
        $school2 = School::create(['name' => 'School B', 'address' => '456 Elm St']);

        // Attach the schools to the user
        $teacher1->schools()->attach([$school1->id, $school2->id]);
    }
}