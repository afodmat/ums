<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class Admin extends Model
{
    use HasRoles, SoftDeletes, Notifiable ;
    protected $fillable =[
        'user_id',
        'phone',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
