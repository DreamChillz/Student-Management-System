@extends('app')

@section('title', 'Enrollment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/enrollments.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div style="height:45px"></div>
        <div class="container">
            <h2>Enroll Course</h2>
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

                <div class="enrollment-controls">
                    <select id="course-select">
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>

                    <button id="add-course-btn">+</button>
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

                <div class="enrollment-table">
                    <table class="enrollment-main-table" id="enrollments-table">
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Date Enrolled</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Existing enrollments from server -->
                            @forelse ($student->enrollments as $enrollment)
                                <tr data-id="{{ $enrollment->id }}">
                                    <td>{{ $enrollment->course->id }}</td>
                                    <td>{{ $enrollment->course->course_name }}</td>
                                    <td>{{ $enrollment->mark ?? '-' }}</td>
                                    <td>{{ $enrollment->grade ?? '-' }}</td>
                                    <td>{{ $enrollment->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <button class="action-btn delete-button" type="button">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No student enrollments record found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Save Button: Only pending enrollments will be submitted when Save is clicked -->
                <div class="save-enrollments">
                    <a href="{{ route('enrollments.index') }}" class="btn back">Back</a>
                    <button class="btn save" id="save-courses-btn" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Array to hold pending enrollments (not yet saved to the DB)
        let pendingEnrollments = [];

        $(document).ready(function() {
            // When user clicks "+" button, add selected course to pendingEnrollments array and table.
            $('#add-course-btn').on('click', function() {
                const courseId = $('#course-select').val();
                const courseText = $("#course-select option:selected").text();
                const studentId = $('#student-id').val();

                if (!courseId) {
                    alert("Please select a course.");
                    return;
                }

                // Optional: prevent adding the same course twice
                if (pendingEnrollments.includes(courseId)) {
                    alert("This course is already pending for enrollment.");
                    return;
                }

                // Check if course is already enrolled by scanning existing table rows
                let alreadyEnrolled = false;
                $('#enrollments-table tbody tr').each(function() {
                    const existingCourseId = $(this).find('td:first').text().trim();
                    const isPending = $(this).hasClass('pending');

                    if (existingCourseId === courseId && !isPending) {
                        alreadyEnrolled = true;
                        return false; // break the loop
                    }
                });

                if (alreadyEnrolled) {
                    alert("This course is already enrolled.");
                    return;
                }

                // Add courseId to pending list
                pendingEnrollments.push(courseId);

                // Append a new row to the table with a "Pending" label for date
                const row = `
                <tr class="pending" data-pending-course-id="${courseId}">
                    <td>${courseId}</td>
                    <td>${courseText}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>Pending</td>
                    <td>
                        <button class="action-btn remove-pending-btn" type="button">Remove</button>
                    </td>
                </tr>
            `;
                $('#enrollments-table tbody').append(row);
            });

            // Remove a pending enrollment row if the user clicks Remove
            $('#enrollments-table').on('click', '.remove-pending-btn', function() {
                const row = $(this).closest('tr');
                const courseId = row.data('pending-course-id');

                // Remove course id from pendingEnrollments
                pendingEnrollments = pendingEnrollments.filter(id => id != courseId);
                row.remove();
            });

            // When the Save button is clicked, send all pending enrollments to the server
            $('#save-courses-btn').on('click', function() {
                const studentId = $('#student-id').val();
                // If no pending enrollments, do nothing.
                if (pendingEnrollments.length === 0) {
                    alert("No courses to save.");
                    return;
                }

                // AJAX request to save all pending enrollments in bulk.
                $.ajax({
                    url: `/enrollments/bulk-save/${studentId}`,
                    method: 'POST',
                    data: {
                        course_ids: pendingEnrollments,
                        _token: $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(res) {
                        if (res.success) {
                            location.href = "{{ route('enrollments.index') }}";
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            });
        });

        $(document).on('click', '.delete-button', function() {
            const row = $(this).closest('tr');
            const enrollmentId = row.data('id');

            if (!confirm('Are you sure you want to delete this enrollment?')) {
                return;
            }

            $.ajax({
                url: `/enrollments/${enrollmentId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.success) {
                        row.remove();
                    } else {
                        alert(res.message || 'Deletion failed.');
                    }
                },
                error: function() {
                    alert('Error deleting record.');
                }
            });
        });
    </script>
@endsection
