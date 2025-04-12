<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()->create([
        //     'name' => 'Tan Jun Eng',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('123'), // Use bcrypt
        // ]);

        Student::create([
            'student_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'gender' => 'Male',
        ]);

        Student::create([
            'student_name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'gender' => 'Female',
        ]);

        Student::create([
            'student_name' => 'Mark Johnson',
            'email' => 'mark.johnson@example.com',
            'gender' => 'Male',
        ]);

        Student::create([
            'student_name' => 'Alice Walker',
            'email' => 'alice.walker@example.com',
            'gender' => 'Female',
        ]);

        Student::create([
            'student_name' => 'Tom Hanks',
            'email' => 'tom.hanks@example.com',
            'gender' => 'Male',
        ]);

        // Manually insert 5 course records
    //     Course::create([
    //         'course_name' => 'Math 101',
    //         'description' => 'Introduction to Mathematics',
    //         'credit_hours' => 3,
    //     ]);

    //     Course::create([
    //         'course_name' => 'Physics 101',
    //         'description' => 'Fundamentals of Physics',
    //         'credit_hours' => 4,
    //     ]);

    //     Course::create([
    //         'course_name' => 'Programming 101',
    //         'description' => 'Introduction to Programming',
    //         'credit_hours' => 3,
    //     ]);

    //     Course::create([
    //         'course_name' => 'English 101',
    //         'description' => 'Basic English Literature',
    //         'credit_hours' => 2,
    //     ]);

    //     Course::create([
    //         'course_name' => 'History 101',
    //         'description' => 'World History Overview',
    //         'credit_hours' => 3,
    //     ]);
    }
    
}
