@extends('app')

@section('title', 'Reports')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reports.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Reports</h2>
            <h4>Generate and view performance reports including average marks per student and per course. Export report data
                into CSV format for external analysis or record-keeping.</h4>

            <div class="report-cards">
                <div class="report">
                    <div class="report-header">
                        <span>Average Marks For Each Student</span>
                        <button id="export-students-btn" class="export-btn">
                            <i class="fa fa-file-excel"></i>
                            <span>Export (CSV)</span>
                        </button>
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
                        <span>Average Marks For Each Course</span>
                        <button id="export-courses-btn" class="export-btn">
                            <i class="fa fa-file-excel"></i>
                            <span>Export (CSV)</span>
                        </button>
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

@section('scripts')
    <script>
        document.getElementById('export-students-btn').addEventListener('click', function() {
            window.location.href = '/reports/export-students'; 
        });

        document.getElementById('export-courses-btn').addEventListener('click', function() {
            window.location.href = '/reports/export-courses'; 
        });
    </script>
@endsection
