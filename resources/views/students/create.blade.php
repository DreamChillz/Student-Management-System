@extends('app')

@section('title', 'Students')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Add New Student</h2>
            <h4>Add student details including personal and contact information.</h4>
            <div class="main-form">
                <form action="{{ route('students.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="student_name">Student Full Name</label>
                        <input type="text" name="student_name" id="student_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group gender-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-buttons">
                        <a href="{{ route('students.index') }}" class="btn back">Back</a>
                        <button type="submit" class="btn submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
