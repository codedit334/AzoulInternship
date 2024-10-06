<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Many-to-many relationship between students and teachers
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher');
    }

    // Many-to-many relationship between students and schools
    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_user');
    }
}