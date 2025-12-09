<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'course_code',
        'course_name',
        'semester',
        'instructor_id',
        'description',
        'is_active',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
