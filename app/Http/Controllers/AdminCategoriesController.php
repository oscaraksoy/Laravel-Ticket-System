<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function create(){
        return view('panel.categories.create');
    }
}
