@extends('app')

@section('title', 'Students')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Edit New Student</h2>
            <h4>Update student details including personal and contact information.</h4>
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

                <form action="{{ route('students.update', $student->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="student_name" class="required">Student Full Name</label>
                        <input type="text" placeholder="Enter name" name="student_name" id="student_name" required
                            value="{{ old('student_name', $student->student_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" placeholder="Enter email" name="email" id="email" required
                            value="{{ old('email', $student->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="required">Gender</label>
                        <select name="gender" id="gender" required>
                            <option value="" disabled>Select Gender</option>
                            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>
                        </select>
                        @error('gender')
                            <small class="text-red">{{ $message }}</small>
                        @enderror
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
