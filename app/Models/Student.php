<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'name'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            if (empty($student->student_id)) {
                $student->student_id = self::generateUniqueStudentId();
            }
        });

    }     

    private static function generateUniqueStudentId()
    {
        do {
            $id = 'S' . rand(100000, 999999); // Generates a random integer with a prefix
        } while (self::where('student_id', $id)->exists());

        return $id;
    }
    
}
