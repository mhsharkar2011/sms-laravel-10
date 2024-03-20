<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'status',
        'is_deleted',
        'created_by',
    ];


    static public function getClass(){
        $return  = self::select('classes.*','users.name as created_by_name')
            ->join('users', 'users.id','classes.created_by')
            ->where('is_deleted','=',0)
            ->orderBy('classes.id', 'desc')
            ->get();
        return $return;
    }
}
