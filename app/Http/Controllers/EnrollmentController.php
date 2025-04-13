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

    //show enrollment form
    public function show($student_id)
    {
        $student = Student::with('enrollments.course')->findOrFail($student_id);
        $courses = Course::all();
        return view('enrollments.enroll', compact('student', 'courses'));
    }


    //to save enrollment form
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

    //to delete enrollment data
    public function destroy(string $id)
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['success' => false, 'message' => 'Enrollment not found.'], 404);
        }

        $enrollment->delete();

        return response()->json(['success' => true]);
    }

    public function showAssignGrade($student_id)
    {
        $student = Student::with('enrollments.course')->findOrFail($student_id);
        $courses = Course::all();
        return view('enrollments.grade', compact('student', 'courses'));
    }

    public function updateMarks(Request $request, $studentId)
    {
        foreach ($request->input('marks', []) as $enrollmentId => $mark) {
            Enrollment::where('id', $enrollmentId)
                ->where('student_id', $studentId)
                ->update(['mark' => $mark]);
        }

        return redirect()->route('enrollments.index')->with('success', 'Marks updated successfully!');
    }
}
