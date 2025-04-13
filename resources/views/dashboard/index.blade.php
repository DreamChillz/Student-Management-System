@extends('app')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <h2 class="greeting">Hello, {{auth()->user()->name}}</h2>
        <div class="container">
            <h2>Home</h2>
            <div class="summary-cards">
                <div class="card">
                    <span class="stat">{{ $totalStudents }}</span>
                    <span class="stat-label">Total Students</span>
                </div>
                <div class="card">
                    <span class="stat">{{ $totalCourses }}</span>
                    <span class="stat-label">Total Courses</span>
                </div>
                <div class="card">
                    <span class="stat">{{ $topCourse->course_name }}</span>
                    <span class="stat-label">Top Scoring Course</span>
                </div>
            </div>
        </div>

        <div class="container">
            <h2>Statistics</h2>
            <div class="report-cards">
                <div class="report">
                    <div class="report-header">
                        <span>Average Marks per Student</span>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Total Courses Enrolled</th>
                                <th>Average Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($avgMarkPerStudents as $avgMarkPerStudent)
                                <tr>
                                    <td>{{ $avgMarkPerStudent->id }}</td>
                                    <td>{{ $avgMarkPerStudent->student_name }}</td>
                                    <td>{{ $avgMarkPerStudent->total_courses }}</td>
                                    <td>{{ $avgMarkPerStudent->average_mark }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No records found.</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="report">
                    <div class="report-header">
                        <span>Average Marks per Course</span>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Total Students</th>
                                <th>Average Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($avgMarkPerCourses as $avgMarkPerCourse)
                                <tr>
                                    <td>{{ $avgMarkPerCourse->id }}</td>
                                    <td>{{ $avgMarkPerCourse->course_name }}</td>
                                    <td>{{ $avgMarkPerCourse->total_students }}</td>
                                    <td>{{ $avgMarkPerCourse->average_mark }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
