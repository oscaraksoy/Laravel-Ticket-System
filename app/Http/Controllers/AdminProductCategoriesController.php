<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductCategoriesController extends Controller
{
    public function create(){
        return view('panel.products.categories.create');
    }
}
