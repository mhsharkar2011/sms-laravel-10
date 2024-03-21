<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    static public function getSubject()
    {
        $return  = self::select('subjects.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'subjects.created_by')
            ->where('is_deleted', '=', 0)
            ->orderBy('subjects.id', 'desc')
            ->get();
        return $return;
    }
}
