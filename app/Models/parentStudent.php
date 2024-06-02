<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class parentStudent extends Model
{
    use HasFactory;

    public static function getParentStudent($parent_id)
    {
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

        return self::select(
                'parent_students.*', 
                'classes.name as class_name',
                DB::raw('GROUP_CONCAT(subjects.name SEPARATOR ", ") as subject_names'),
                DB::raw("CONCAT(students.first_name, ' ', students.last_name) AS student_name"),
                DB::raw("CONCAT(teachers.first_name, ' ', teachers.last_name) AS teacher_name"),
                'students.roll_number as student_roll_number',
                'students.email as student_email',
                'students.contact_number as student_contact_number',
                'students.admission_date as student_admission_date',
                'teachers.contact_number as teacher_contact_number',
                'teachers.email as teacher_email'
            )
            ->join('class_students', 'class_students.student_id', '=', 'parent_students.student_id')
            ->join('classes', 'classes.id', '=', 'class_students.class_id')
            ->join('class_subjects', 'class_subjects.class_id', '=', 'classes.id')
            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->join('users as students', 'students.id', '=', 'class_students.student_id')
            ->join('class_teachers', 'class_teachers.class_id', '=', 'classes.id')
            ->join('users as teachers', 'teachers.id', '=', 'class_teachers.teacher_id')
            ->where('parent_students.parent_id', $parent_id)
            ->where('parent_students.is_deleted', 0)
            ->where('parent_students.status', 0)
            ->where('classes.is_deleted', 0)
            ->where('classes.status', 0)
            ->where('class_subjects.is_deleted', 0)
            ->where('class_subjects.status', 0)
            ->where('subjects.is_deleted', 0)
            ->where('subjects.status', 0)
            ->groupBy(
                'parent_students.id',
                'classes.name',
                'students.first_name', 
                'students.last_name',
                'teachers.first_name', 
                'teachers.last_name', 
                'students.roll_number', 
                'students.email', 
                'students.contact_number', 
                'students.admission_date', 
                'teachers.contact_number', 
                'teachers.email'
            )
            ->get();
    }

}
