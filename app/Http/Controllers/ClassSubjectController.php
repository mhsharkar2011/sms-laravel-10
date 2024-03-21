<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function index(ClassSubject $assignSubject)
    {
        $data['header_title'] ='Subject Assignment';
        $data['assignSubject'] = $assignSubject;
        return view('admin.assign_subject.list',$data);
    }
}
