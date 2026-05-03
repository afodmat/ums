<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model

{
    use  HasFactory,HasApiTokens,Notifiable, SoftDeletes;
    protected $fillable = [
        'date_of_birth',
        'gender',
        'user_number',
        'nin_number',
        'age',
        'enrollment_date',
        'is_enrolled',
        'address',
        'nationality',
        'course_id',
        'guardian_name',
        'guardian_contact',
        'guardian_relationship',
        'guardian_address',
        'admission_year',
        'study_mode',
        'academic_status',
        'photo'
    ];
}
