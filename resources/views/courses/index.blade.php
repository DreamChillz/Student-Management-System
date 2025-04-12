@extends('app')

@section('title', 'Courses')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Course Details</h2>
            <h4>Create or edit course information such as course name, description, and credit hours.</h4>
            <div class="main-table">
                <div class="main-table-header">
                    <button class="add-button" onclick="window.location.href='{{ route('courses.create') }}'">Add New
                        Course</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Credit Hours</th>
                            <th>Date Added</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>{{ $course->created_at->format('Y-m-d') }}</td>
                                <td style="text-align:center">
                                    <button class=" action-btn edit-button"
                                        onclick="window.location.href='{{ route('courses.edit', $course->id) }}'">Edit</button>

                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this course?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" action-btn delete-button"type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No course records found.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
