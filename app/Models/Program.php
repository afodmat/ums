<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use  HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'program_name',
        'duration_years',
        'duration_semesters',
        'fees',
        'description',
        'degree_type',
        'status',
        'entry_requirements',
    ];
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($program) {
            $program->program_code = self::generateProgramCode($program->program_name);
        });
    }

    public static function generateProgramCode($programName)
    {
        // Method 1: Based on program name (e.g., "Bachelor of Computer Science" -> "BCS")
        $words = preg_split('/[\s]+/', $programName);
        $code = '';
        foreach ($words as $word) {
            $code .= strtoupper(substr($word, 0, 1));
        }
        
        // Make it unique
        $originalCode = $code;
        $counter = 1;
        while (self::where('program_code', $code)->exists()) {
            $code = $originalCode . $counter;
            $counter++;
        }
        
        return $code;
    }


    public function students()
    {
        return $this->hasMany(Student::class, 'program_id');
    }
}
