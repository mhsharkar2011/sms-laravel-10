<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassTeacher extends Model
{
    use HasFactory;

    protected  $table = 'class_teachers';

    protected $guarded = [
        'id',
    ];

    static function getAssignTeacherId($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_deleted', '=', 0)->get();
    }

    static function deleteTeacher($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }

    static function getMyClassSubject($teacher_id)
    {
        return self::select('class_teachers.*', 'classes.name as class_name','subjects.name as subject_name')
            ->join('classes', 'classes.id', '=', 'class_teachers.class_id')
            ->join('class_subjects', 'class_subjects.class_id', '=', 'classes.id')
            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->where('class_teachers.teacher_id', '=',$teacher_id)
            ->where('class_teachers.is_deleted', '=',0)
            ->where('class_teachers.is_deleted', '=',0)
            ->where('class_teachers.status', '=',0)
            ->where('classes.is_deleted', '=',0)
            ->where('classes.status', '=',0)
            ->where('class_subjects.is_deleted', '=',0)
            ->where('class_subjects.status', '=',0)
            ->where('subjects.is_deleted', '=',0)
            ->where('subjects.status', '=',0)
            ->get();
    }

    // public function classStudents()
    // {
    //     return $this->hasMany(ClassStudent::class, 'class_id', 'class_id');
    // }
}
