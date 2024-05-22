<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $data['header_title'] = 'Admin List';
        $data['getAdmin'] = User::getAdmin();
        return view('admin.admin-list', $data);
    }

}
