<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'employee_number',
        'department',
        'position',
        'phone',
        'photo',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}