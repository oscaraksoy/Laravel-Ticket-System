<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function create(){
        return view('panel.users.create');
    }
}
