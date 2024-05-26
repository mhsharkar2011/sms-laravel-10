<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;

    public function classTeachers()
    {
        return $this->hasMany(ClassTeacher::class, 'class_id', 'class_id');
    }
}
