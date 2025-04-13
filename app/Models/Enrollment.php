<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['student_id', 'course_id', 'mark'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getGradeAttribute()
    {
        if (is_null($this->mark)) {
            return '-'; // or return a default value like 'N/A'
        }

        $mark = $this->mark;

        if ($mark >= 80) {
            return 'A';
        } elseif ($mark >= 70) {
            return 'B';
        } elseif ($mark >= 60) {
            return 'C';
        } elseif ($mark >= 50) {
            return 'D';
        } elseif ($mark >= 40) {
            return 'E';
        } else {
            return 'F';
        }
    }
}
