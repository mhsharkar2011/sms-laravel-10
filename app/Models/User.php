<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    static public function getUser()
    {
        return self::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
            ->orderBy('id', 'desc')
            ->get();
    }

    static public function getAdmin()
    {
        $return = self::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
            ->orderBy('id', 'desc')
            ->where('user_type', '=', '1')
            // ->where('is_deleted', '=', '0')
            ->orderBy('id', 'desc');
            if (!empty(Request::get('first_name'))) {
                $return = $return->where('users.first_name', 'LIKE', '%' . Request::get('first_name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'LIKE', '%' . Request::get('last_name') . '%');
            }
             if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }
            $return = $return->get();

            return $return;
    }

    static public function getTeacher()
    {
        $return = self::select('users.*',DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
            ->where('user_type', '=', '2')
            ->where('is_deleted', '=', '0')
            ->orderBy('id', 'desc');
            if (!empty(Request::get('first_name'))) {
                $return = $return->where('users.first_name', 'LIKE', '%' . Request::get('first_name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'LIKE', '%' . Request::get('last_name') . '%');
            }
             if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }
            $return = $return->get();
            return $return;
    }

    static public function getStudent()
    {
        $return = self::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
            ->where('user_type', '=', '3')
            ->where('is_deleted', '=', '0')
            ->orderBy('id', 'desc');
            if (!empty(Request::get('first_name'))) {
                $return = $return->where('users.first_name', 'LIKE', '%' . Request::get('first_name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'LIKE', '%' . Request::get('last_name') . '%');
            }
             if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }
            $return = $return->get();
            return $return;

    }

    static public function getTeacherStudent(){
        $return = self::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"),'classes.name as class_name')
            ->join('classes', 'classes.id', '=', 'users.class_id')
            ->where('users.user_type', '=', '3')
            ->where('users.is_deleted', '=', '0')
            ->orderBy('users.id', 'desc');
            if (!empty(Request::get('first_name'))) {
                $return = $return->where('users.first_name', 'LIKE', '%' . Request::get('first_name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'LIKE', '%' . Request::get('last_name') . '%');
            }
             if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }
            $return = $return->get();
            return $return;
    }


    static public function getParent()
    {
        $return = self::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
            ->where('user_type', '=', '4')
            ->where('is_deleted', '=', '0')
            ->orderBy('id', 'desc');
            if (!empty(Request::get('first_name'))) {
                $return = $return->where('users.first_name', 'LIKE', '%' . Request::get('first_name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'LIKE', '%' . Request::get('last_name') . '%');
            }
             if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }
            $return = $return->get();
            return $return;
    }
    static function getSingleUser($id)
    {
        return self::where('id', '=', $id)->first();
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
