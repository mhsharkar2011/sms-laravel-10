<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    static public function getSubject()
    {
        $return  = self::select(
            'subjects.*', 
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name")
            )
            ->join('users', 'users.id', 'subjects.created_by')
            ->where('subjects.status', '=', 0)
            ->where('subjects.is_deleted', '=', 0)
            ->orderBy('subjects.id', 'asc')
            ->get();
        return $return;
    }

    public function classes()
    {
        return $this->belongsTo(ClassModel::class);
    }
}
