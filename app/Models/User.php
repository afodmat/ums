<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'user_number',
        'email'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function generateUserNumber($role): string
    {
        $prefix = match ($role) {
            'admin' => 'AD',
            'student' => 'ST',
            'lecturer' => 'LEC',
            'finance' => 'FIN',
            default => 'US',
        };

        $last = self::where('user_number', 'like', $prefix.'%')
            ->orderBy('user_number', 'desc')
            ->first();

        if (!$last) {
            $next = 1;
        } else {
            $number = (int) substr($last->user_number, strlen($prefix));
            $next = $number + 1;
        }

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

     public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
