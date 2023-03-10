<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminStaffsController extends Controller
{
    public function create(){
        return view('panel.staffs.create');
    }
}
