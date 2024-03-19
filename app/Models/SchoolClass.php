<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    static public function getClass(){
        return self::select('school_classes.*')
            ->where('is_delete','=',0)
            ->orderBy('id', 'desc')
            ->get();
    }
}
