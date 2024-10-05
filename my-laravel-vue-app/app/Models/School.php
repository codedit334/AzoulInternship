<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];  // Add 'name' and other attributes here

    public function users()
{
    return $this->belongsToMany(User::class, 'school_user');
}
}