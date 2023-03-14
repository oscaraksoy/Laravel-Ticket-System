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

    public function update(Category $category){
        $attributes = request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $category->update($attributes);

        return redirect('/admin/categories')->with('dialogMessage', 'Category has been updated');
    }
}
