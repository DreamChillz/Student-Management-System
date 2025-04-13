<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
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
        $mark = $this->mark;

        if ($mark >= 90) {
            return 'A';
        } elseif ($mark >= 80) {
            return 'B';
        } elseif ($mark >= 70) {
            return 'C';
        } elseif ($mark >= 60) {
            return 'D';
        } elseif ($mark >= 50) {
            return 'E';
        } else {
            return 'F';
        }
    }
}
