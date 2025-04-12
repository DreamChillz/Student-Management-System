<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_name',
        'email',        // add other fields you use
        'gender',
    ];

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class,'enrollments')->withPivot('mark');
    }
}
