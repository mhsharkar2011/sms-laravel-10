<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassSubject extends Model
{
    use HasFactory;
    protected  $table = 'class_subjects';

    protected $guarded = [
        'id',
    ];


    // static function getClassSubject()
    // {
    //     return self::select(
    //         'classes.id as class_id',
    //         'classes.name as class_name',
    //         DB::raw('GROUP_CONCAT(subjects.name SEPARATOR ", ") as subject_name'),
    //         'users.first_name as created_by_name'
    //     )
    //         ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
    //         ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
    //         ->join('users', 'users.id', '=', 'class_subjects.created_by')
    //         ->where('class_subjects.is_deleted', 0)
    //         ->where('class_subjects.status', 0)
    //         ->where('classes.is_deleted', 0)
    //         ->where('classes.status', 0)
    //         ->where('subjects.is_deleted', 0)
    //         ->where('subjects.status', 0)
    //         ->groupBy(
    //             'users.id',
    //             'classes.id',
    //             'classes.name',
    //             'class_subjects.created_at'
    //         );
    // }

    static function getClassSubject()
    {
        return self::select('class_subjects.*', 
                            'classes.name as class_name', 
                            'subjects.name as subject_name', 
                            'users.first_name as created_by_name'
                            )
                            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                            ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
                            ->join('users', 'users.id', '=', 'class_subjects.created_by')
                            ->where('class_subjects.is_deleted', 0);
    }

    static function getAssignSubjectId($class_id){
        return self::where('class_id', '=', $class_id)->where('is_deleted','=',0)->get();
    }

    static function deleteSubject($class_id){
        return self::where('class_id', '=', $class_id)->delete();
    }
}
