@extends('app')

@section('title', 'Courses')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Edit Course</h2>
            <h4>Edit course information such as course name, description, and credit hours.</h4>
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

                <form action="{{ route('courses.update', $course->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="course_name" class="required">Course Name</label>
                        <input type="text" placeholder="Enter course name" name="course_name" id="course_name" required
                            value="{{ old('course_name', $course->course_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="description" class="required">Description</label>
                        <textarea name="description" placeholder="Enter description" id="description" required>{{ old('description', $course->description) }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="credit_hours" class="required">Credit Hours</label>
                        <input type="number" placeholder="Enter credit hours" name="credit_hours" id="credit_hours"
                            required value="{{ old('credit_hours', $course->credit_hours) }}">

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
