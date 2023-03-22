<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function create(){
        return view('panel.categories.create');
    }

    public function show(Category $category){
        return view('panel.categories.show', [
            'category' => $category
        ]);
    }

    public function add(){
        return view("panel.categories.add");
    }

    public function store(){
        $attributes = request()->validate([
           'name' => ['min:3']
        ]);

        Category::create($attributes);

        return redirect("/admin/categories")->with('dialogMessage', 'Categories created successfully.');
    }

    public function update(Category $category){
        $attributes = request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $category->update($attributes);

        return redirect('/admin/categories')->with('dialogMessage', 'Category has been updated');
    }
}
