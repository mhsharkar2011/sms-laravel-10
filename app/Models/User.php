<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'is_delete',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getAdmin()
    {
        return self::select('users.*')
            ->where('user_type', '=', '1')
            ->where('is_delete', '=', '0')
            ->orderBy('id', 'desc')
            ->get();
    }

    static public function getTeacher()
    {
        return self::select('users.*')
            ->where('user_type', '=', '2')
            ->where('is_delete', '=', '0')
            ->orderBy('id', 'desc')
            ->get();
    }

    static public function getStudent()
    {
        return self::select('users.*')
            ->where('user_type', '=', '3')
            ->where('is_delete', '=', '0')
            ->orderBy('id', 'desc')
            ->get();
    }

    static public function getParent()
    {
        return self::select('users.*')
            ->where('user_type', '=', '4')
            ->where('is_delete', '=', '0')
            ->orderBy('id', 'desc')
            ->get();
    }
    static function getSingleEmail($email)
    {
        return self::where('email', '=', $email)->first();
    }

    static function getSingleToken($remember_token)
    {
        return self::where('remember_token', '=', $remember_token)->first();
    }
}
