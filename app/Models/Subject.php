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
    
    static public function getSubject(){
        return Subject::where('is_delete',0)
                ->orderBy('id','DESC')
                ->get();
    }
}
