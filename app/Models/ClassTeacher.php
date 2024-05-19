<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;

    protected  $table = 'class_teachers';

    protected $guarded = [
        'id',
    ];

    static function getAssignTeacherId($class_id){
        return self::where('class_id', '=', $class_id)->where('is_deleted','=',0)->get();
    }

    static function deleteTeacher($class_id){
        return self::where('class_id', '=', $class_id)->delete();
    }

}
