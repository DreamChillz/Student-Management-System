<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('enrollments')->insert([
            [
                'student_id' => 6,
                'course_id' => 1,
                'mark' => 85,
            ],
            [
                'student_id' => 6,
                'course_id' => 2,
                'mark' => 78,
            ],
            [
                'student_id' => 7,
                'course_id' => 1,
                'mark' => 92,
            ],
            [
                'student_id' => 8,
                'course_id' => 3,
                'mark' => 66,
            ],
            [
                'student_id' => 9,
                'course_id' => 2,
                'mark' => 74,
            ],
        ]);
    }
}
