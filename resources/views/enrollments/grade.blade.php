@extends('app')

@section('title', 'Enrollment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/enrollments.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Assign Grades</h2>
            <h4>Enroll students in courses and assign grades for each enrollment.</h4>
            <div class="enrollment-card">
                <div class="enrollment-header">
                    <input type="hidden" id="student-id" value="{{ $student->id }}">
                    <table class="enrollment-header-table">
                        <tbody>
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->student_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if ($errors->any())
                    <div class="alert" style="color:red">
                        <ul style="list-style:none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('enrollments.updateMarks', $student->id) }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="enrollment-table">
                        <table class="enrollment-main-table" id="enrollments-table">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Course Name</th>
                                    <th>Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Existing enrollments from server -->
                                @forelse ($student->enrollments as $enrollment)
                                    <tr data-id="{{ $enrollment->id }}">
                                        <td>{{ $enrollment->course->id }}</td>
                                        <td>{{ $enrollment->course->course_name }}</td>
                                        <td><input class="mark-input" type="number" name="marks[{{ $enrollment->id }}]"
                                                value="{{ $enrollment->mark }}" min="0" max="100">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No student enrollments record found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="save-enrollments">
                        <a href="{{ route('enrollments.index') }}" class="btn back">Back</a>
                        <button class="btn save" id="save-courses-btn" type="submit">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
