<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'teacher_id',
        'lvl', 
        'city', 
        'sex', 
        'subject', 
        'address',
        'school',
        'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function students()
    // {
    //     return $this->hasMany(User::class, 'teacher_id');
    // }

    // A student belongs to a teacher
    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'student_teacher');
    // }

    public function students()
{
    return $this->belongsToMany(User::class, 'student_teacher', 'teacher_id', 'student_id');
}

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'student_teacher', 'teacher_id', 'student_id');
        //return $this->belongsToMany(Teacher::class, 'student_teacher');
    }


    public function schools()
{
    return $this->belongsToMany(School::class, 'school_user');
}
}