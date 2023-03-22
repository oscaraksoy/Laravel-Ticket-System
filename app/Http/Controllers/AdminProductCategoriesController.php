<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AdminProductCategoriesController extends Controller
{
    public function create(){
        return view('panel.products.categories.create');
    }

    public function add(){
        return view('panel.products.categories.add', [
            'parentCategories' => ProductCategory::getParents()
        ]);
    }

    public function store(){
        $attributes = request()->validate([
            'name' => ['min:3'],
            'category' => ['nullable']
        ]);

        ProductCategory::create([
            'name' => $attributes['name'],
            'parent_id' => array_key_exists('category', $attributes) ? $attributes['category'] : null
        ]);

        return redirect("/admin/product-categories")->with('dialogMessage', 'Product category created successfully.');
    }
}
