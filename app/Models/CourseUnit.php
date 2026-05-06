<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseUnit extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'code',
        'description',
        'program_id',
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($courseUnit) {
            // Only generate code if not provided
            if (!$courseUnit->code) {
                $prefix = 'CU'; // Course Unit prefix
                $lastId = self::max('id') + 1;
                $courseUnit->code = strtoupper($prefix) . '-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);
            }
        });
    }
    
    // Relationship with Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}