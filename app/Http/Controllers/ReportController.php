<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index()
    {

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

        return view('reports.index', compact('avgMarkPerStudents', 'avgMarkPerCourses'));
    }

    public function exportStudents(): StreamedResponse
    {
        $data = DB::table('enrollments')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->select(
                'students.id',
                'students.student_name',
                DB::raw('COUNT(enrollments.course_id) as total_courses'),
                DB::raw('AVG(enrollments.mark) as average_mark')
            )
            ->groupBy('students.id', 'students.student_name')
            ->havingRaw('AVG(enrollments.mark) IS NOT NULL')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="student_report.csv"',
        ];

        $columns = ['Student ID', 'Student Name', 'Total Courses Enrolled', 'Average Mark'];

        return response()->stream(function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->student_name,
                    $row->total_courses,
                    number_format($row->average_mark, 2),
                ]);
            }

            fclose($file);
        }, 200, $headers);
    }

    public function exportCourses(): StreamedResponse
    {
        $data = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select(
                'courses.id',
                'courses.course_name',
                DB::raw('COUNT(enrollments.student_id) as total_students'),
                DB::raw('AVG(enrollments.mark) as average_mark')
            )
            ->groupBy('courses.id', 'courses.course_name')
            ->havingRaw('AVG(enrollments.mark) IS NOT NULL')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="course_report.csv"',
        ];

        $columns = ['Course ID', 'Course Name', 'Total Students', 'Average Mark'];

        return response()->stream(function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->course_name,
                    $row->total_students,
                    number_format($row->average_mark, 2),
                ]);
            }

            fclose($file);
        }, 200, $headers);
    }
}
