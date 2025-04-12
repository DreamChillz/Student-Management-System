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
                    <button class="add-button" onclick="window.location.href='{{ route('students.create') }}'">Add New
                        Student</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Date Added</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->student_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->created_at->format('Y-m-d') }}</td>
                                <td style="text-align:center">
                                    <button class=" action-btn edit-button"
                                        onclick="window.location.href='{{ route('students.edit', $student->id) }}'">Edit</button>

                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" action-btn delete-button"type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No student records found.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
