@extends('app')

@section('title', 'Enrollment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/enrollments.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Course Enrollment</h2>
            <h4>Enroll students in courses and assign grades for each enrollment.</h4>
            <div class="enrollment-list">
                @foreach ($students as $student)
                    <div class="enrollment-card">
                        <div class="enrollment-header">
                            <table class="student-info-table">
                                <tbody>
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->student_name }}</td>
                                        <td>
                                            <div class="button-group">
                                                <a href="{{ route('enrollments.show', $student->id) }}"
                                                    class="btn btn-primary">Enroll
                                                    Course</a>
                                                <a href="" class="btn btn-secondary">Assign
                                                    Grades</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="enrollment-table">
                            <table class="enrollment-main-table">
                                <tbody>
                                    @forelse ($student->enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->course->id }}</td>
                                            <td>{{ $enrollment->course->course_name }}</td>
                                            <td>{{ $enrollment->mark ?? '-' }}</td>
                                            <td>{{ $enrollment->grade ?? '-' }}</td>
                                            <td>12-04-2025</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No student enrollments record found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

