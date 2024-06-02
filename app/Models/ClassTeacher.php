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
        return self::select(
            'class_teachers.id',
            'class_teachers.teacher_id',
            'class_teachers.class_id',
            'class_teachers.status',
            'class_teachers.is_deleted',
            'class_teachers.created_at',
            'classes.name as class_name',
            // 'subjects.name as subject_name',
            DB::raw('GROUP_CONCAT(subjects.name SEPARATOR ", ") as subject_name')
        )
            ->join('classes', 'classes.id', '=', 'class_teachers.class_id')
            ->join('class_subjects', 'class_subjects.class_id', '=', 'classes.id')
            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->where('class_teachers.teacher_id', $teacher_id)
            ->where('class_teachers.is_deleted', 0)
            ->where('class_teachers.status', 0)
            ->where('classes.is_deleted', 0)
            ->where('classes.status', 0)
            ->where('class_subjects.is_deleted', 0)
            ->where('class_subjects.status', 0)
            ->where('subjects.is_deleted', 0)
            ->where('subjects.status', 0)
            ->groupBy(
                'class_teachers.id',
                'class_teachers.teacher_id', 
                'class_teachers.class_id', 
                'class_teachers.status', 
                'class_teachers.is_deleted',
                'class_teachers.created_at',
                'classes.name'
            )
            ->get();
    }

    static function getTeacherStudent($teacher_id)
    {
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

        return self::select(
            'class_teachers.*',
            'classes.name as class_name',
            DB::raw('GROUP_CONCAT(subjects.name SEPARATOR ", ") as subject_names'),
            DB::raw("CONCAT(parents.first_name, ' ', parents.last_name) AS parent_name"),
            'students.roll_number as roll_number',
            'students.first_name as student_name',
            'students.email as student_email',
            'students.contact_number as student_contact_number',
            'students.admission_date as student_admission_date',
            'parents.contact_number as parent_contact_number',
            'parents.email as parent_email'
        )
            ->join('classes', 'classes.id', '=', 'class_teachers.class_id')
            ->join('class_subjects', 'class_subjects.class_id', '=', 'classes.id')
            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->join('class_students', 'class_students.class_id', '=', 'classes.id')
            ->join('users as students', 'students.id', '=', 'class_students.student_id')
            ->join('users as parents', 'parents.id', '=', 'students.parent_id')
            ->where('class_teachers.teacher_id', $teacher_id)
            ->where('class_teachers.is_deleted', 0)
            ->where('class_teachers.status', 0)
            ->where('classes.is_deleted', 0)
            ->where('classes.status', 0)
            ->where('class_subjects.is_deleted', 0)
            ->where('class_subjects.status', 0)
            ->where('subjects.is_deleted', 0)
            ->where('subjects.status', 0)
            ->groupBy(
                'class_students.id',
                'classes.name',
                'students.first_name',
                'students.email',
                'parents.first_name',
                'parents.email',
                'students.contact_number',
                'parents.contact_number',
                'students.admission_date'
            )
            ->get();
    }
}
