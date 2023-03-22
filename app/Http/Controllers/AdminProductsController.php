<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class AdminProductsController extends Controller
{
    public function create(){
        return view('panel.products.create', [
            'products' => Product::all()
        ]);
    }

    public function show(Product $product){
        return view('panel.products.show', [
            'product' => $product,
            'categories' => ProductCategory::getGroupedCategories()
        ]);
    }

    public function add(){
        return view('panel.products.add', [
            'categories' => ProductCategory::getGroupedCategories()
        ]);
    }

    public  function store(){
        $attributes = request()->validate([
            'name' => ['required', 'min:5'],
            'product_category_id' => ['required']
        ]);

        Product::create($attributes);

        return redirect('/admin/products')->with('dialogMessage', 'Product has created successfully.');
    }

    public function update(Product $product){
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'product_category_id' => ['required']
        ]);

        $product->update($attributes);

        return redirect('/admin/products')->with('dialogMessage', 'Product has been updated');
    }
}
