<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'student_number',
        'program_id',
        'enrollment_date',
        'expected_graduation_date',
        'current_semester',
        'academic_status', // active, suspended, graduated, withdrawn
        'parent_name',
        'parent_phone',
        'parent_email',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'high_school_name',
        'high_school_gpa',
        'previous_institution',
        'transfer_credits',
        'photo',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'expected_graduation_date' => 'date',
        'current_semester' => 'integer',
        'transfer_credits' => 'integer',
        'high_school_gpa' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('academic_status', 'active');
    }

    public function scopeByProgram($query, $programId)
    {
        return $query->where('program_id', $programId);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->user ? $this->user->first_name . ' ' . $this->user->last_name : 'N/A';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'active' => 'bg-green-100 text-green-800',
            'suspended' => 'bg-red-100 text-red-800',
            'graduated' => 'bg-blue-100 text-blue-800',
            'withdrawn' => 'bg-gray-100 text-gray-800',
        ];
        
        return $badges[$this->academic_status] ?? 'bg-gray-100 text-gray-800';
    }
}