<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $guarded = [
        'name',
        'status',
        'is_deleted',
        'created_by',
    ];


    static public function getClass(){
        $return  = self::select('classes.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
            ->join('users', 'users.id','classes.created_by')
            ->orderBy('classes.id', 'desc')
            ->get();
        return $return;
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
    
}
