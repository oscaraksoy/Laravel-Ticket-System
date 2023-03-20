<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class CategoriesController extends Controller
{
    public function create(){
        return view('categories.create',[
            'categories' => ProductCategory::getParents(),
            'counts' => Product::productCountsByCategory(),
        ]);
    }
}
