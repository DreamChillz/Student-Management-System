<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = DB::table('students')->count();
        $totalCourses = DB::table('courses')->count();

        $topCourse = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select('courses.course_name', DB::raw('AVG(enrollments.mark) as average_mark'))
            ->groupBy('courses.id', 'courses.course_name')
            ->orderByDesc('average_mark')
            ->limit(1)
            ->first();

        $avgMarkPerStudents = DB::table('enrollments')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->select(
                'students.id',
                'students.student_name',
                DB::raw('AVG(enrollments.mark) as average_mark'),
                DB::raw('COUNT(enrollments.course_id) as total_courses')
            )
            ->groupBy('students.id', 'students.student_name')
            ->havingRaw('AVG(enrollments.mark) IS NOT NULL')
            ->orderByDesc('average_mark')
            ->get();


        $avgMarkPerCourses = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select('courses.id', 'courses.course_name', DB::raw('AVG(enrollments.mark) as average_mark'), DB::raw('COUNT(enrollments.student_id) as total_students'))
            ->groupBy('courses.id', 'courses.course_name')
            ->havingRaw('AVG(enrollments.mark) IS NOT NULL')
            ->orderByDesc('average_mark')
            ->get();

        return view('dashboard.index', compact('totalStudents', 'totalCourses', 'topCourse', 'avgMarkPerStudents', 'avgMarkPerCourses'));
    }

}
