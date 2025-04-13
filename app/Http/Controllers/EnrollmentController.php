<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['enrollments.course'])->get();
        return view('enrollments.index', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $student = Student::with('enrollments.course')->findOrFail($student_id);
        $courses = Course::all();
        return view('enrollments.enroll', compact('student', 'courses'));
    }

    public function addCourse(Request $request, $studentId)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if the enrollment already exists
        $exists = Enrollment::where('student_id', $studentId)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Student is already enrolled in this course.'
            ]);
        }

        // Create the new enrollment
        $enrollment = Enrollment::create([
            'student_id' => $studentId,
            'course_id' => $request->course_id,
            'mark' => null, // default
        ]);

        // Load related course info for the response
        $enrollment->load('course');

        return response()->json([
            'success' => true,
            'enrollment' => $enrollment
        ]);
    }


    public function bulkSave($studentId, Request $request)
    {
        $validated = $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $courseIds = $validated['course_ids'];

        // Loop over each course id and create an enrollment if it does not exist
        foreach ($courseIds as $courseId) {
            // Optionally check if the student is already enrolled in this course.
            \App\Models\Enrollment::firstOrCreate([
                'student_id' => $studentId,
                'course_id'  => $courseId,
            ], [
                'mark' => null  // default mark is null
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Enrollments saved successfully!'
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['success' => false, 'message' => 'Enrollment not found.'], 404);
        }

        $enrollment->delete();

        return response()->json(['success' => true]);
    }
}
