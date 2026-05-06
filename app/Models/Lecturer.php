<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'lecturer_number',
        'specialization',
        'qualification',
        'years_of_experience',
        'join_date',
        'employment_type', // full_time, part_time, contract
        'office_location',
        'office_phone',
        'consultation_hours',
        'research_interests',
        'publications',
        'photo',
        'biography',
        'status', // active, on_leave, terminated
    ];

    protected $casts = [
        'join_date' => 'date',
        'years_of_experience' => 'integer',
        'consultation_hours' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function courses()
    {
        return $this->belongsToMany(CourseUnit::class, 'course_lecturer')
                    ->withPivot('semester', 'academic_year')
                    ->withTimestamps();
    }

    public function advisings()
    {
        return $this->hasMany(Student::class, 'advisor_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->user ? $this->user->first_name . ' ' . $this->user->last_name : 'N/A';
    }

    public function getQualificationListAttribute()
    {
        return is_array($this->qualification) 
            ? implode(', ', $this->qualification) 
            : $this->qualification;
    }
}