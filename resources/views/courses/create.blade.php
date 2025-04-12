@extends('app')

@section('title', 'Courses')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Add New Course</h2>
            <h4>Create course information such as course name, description, and credit hours.</h4>
            <div class="main-form">
                @if ($errors->any())
                    <div class="alert" style="color:red">
                        <ul style="list-style:none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('courses.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="course_name" class="required">Course Name</label>
                        <input type="text" placeholder="Enter course name" name="course_name" id="course_name" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="required">Description</label>
                        <textarea name="description" placeholder="Enter description" id="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="credit_hours" class="required">Credit Hours</label>
                        <input type="number" placeholder="Enter credit hours" name="credit_hours" id="credit_hours" required>
                    </div>
                    <div class="form-buttons">
                        <a href="{{ route('courses.index') }}" class="btn back">Back</a>
                        <button type="submit" class="btn submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
