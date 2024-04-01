<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;
    protected  $table = 'class_subjects';

    protected $guarded = [
        'id',
    ];

    static function getAssignSubjectId($class_id){
        return self::where('class_id', '=', $class_id)->where('is_deleted','=',0)->get();
    }

    static function deleteSubject($class_id){
        return self::where('class_id', '=', $class_id)->delete();
    }
}
