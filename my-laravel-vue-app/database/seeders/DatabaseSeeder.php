<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'city' => 'Admin City',
            'sex' => 'Male',
            'address' => '123 Admin St',
            'level' => null,
        ]);

        // Create 2 Teachers
        $teacher1 = User::create([
            'name' => 'Teacher One',
            'email' => 'teacher1@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'city' => 'City 1',
            'sex' => 'Female',
            'address' => '123 Teacher St',
            'level' => null,
        ]);

        $teacher2 = User::create([
            'name' => 'Teacher Two',
            'email' => 'teacher2@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'city' => 'City 2',
            'sex' => 'Male',
            'address' => '456 Teacher St',
            'level' => null,
        ]);

        // Insert into the teachers table with the subject field
        Teacher::create([
            'user_id' => $teacher1->id,
            'subject' => 'Math', // Teacher's subject
        ]);

        Teacher::create([
            'user_id' => $teacher2->id,
            'subject' => 'Science', // Teacher's subject
        ]);

        // Create 4 Students and assign 2 to each teacher
        $student1 = User::create([
            'name' => 'Student One',
            'email' => 'student1@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'city' => 'Student City 1',
            'sex' => 'Female',
            'address' => '789 Student St',
            'level' => 1,
        ]);

        $student2 = User::create([
            'name' => 'Student Two',
            'email' => 'student2@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'city' => 'Student City 2',
            'sex' => 'Male',
            'address' => '123 Student St',
            'level' => 2,
        ]);

        $student3 = User::create([
            'name' => 'Student Three',
            'email' => 'student3@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'city' => 'Student City 3',
            'sex' => 'Male',
            'address' => '456 Student St',
            'level' => 1,
        ]);

        $student4 = User::create([
            'name' => 'Student Four',
            'email' => 'student4@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'city' => 'Student City 4',
            'sex' => 'Female',
            'address' => '789 Student St',
            'level' => 2,
        ]);

        // Assign 2 students to each teacher (many-to-many relationship)
        $teacher1->students()->attach([$student1->id, $student2->id]);
        $teacher2->students()->attach([$student3->id, $student4->id]);

        // Create 4 Schools
        $school1 = School::create([
            'name' => 'School One',
            'address' => 'School Street 1',
        ]);

        $school2 = School::create([
            'name' => 'School Two',
            'address' => 'School Street 2',
        ]);

        $school3 = School::create([
            'name' => 'School Three',
            'address' => 'School Street 3',
        ]);

        $school4 = School::create([
            'name' => 'School Four',
            'address' => 'School Street 4',
        ]);

        // Assign 2 schools to each teacher (many-to-many relationship)
        $teacher1->schools()->attach([$school1->id, $school2->id]);
        $teacher2->schools()->attach([$school3->id, $school4->id]);

        // Assign 1 school to all students (many-to-many relationship)
        $student1->schools()->attach($school1->id);
        $student2->schools()->attach($school1->id);
        $student3->schools()->attach($school1->id);
        $student4->schools()->attach($school1->id);
    }
}