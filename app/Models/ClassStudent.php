<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ClassStudent extends Model
{
    use HasFactory;

    protected  $table = 'class_students';

    protected $guarded = [
        'id',
    ];

    static function getAssignStudentRecord()
    {
        $return = self::select(
            'class_students.id',
            'class_students.class_id',
            'class_students.student_id',
            'classes.name as class_name',
            DB::raw("CONCAT(students.first_name, ' ', students.last_name) AS student_name"
            ))
            ->join('users as students', 'students.id', '=', 'class_students.student_id')
            ->join('classes', 'classes.id', '=', 'class_students.class_id')
            ->where('students.user_type', '=', '3')
            ->where('students.is_deleted', '=', '0')
            ->orderBy('classes.id', 'desc');

            if (!empty(Request::get('full_name'))) {
                $return = $return->where('users.full_name', 'LIKE', '%' . Request::get('full_name') . '%');
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

    static function getAssignStudent()
    {

        return self::pluck('student_id')->toArray();
    }
}
