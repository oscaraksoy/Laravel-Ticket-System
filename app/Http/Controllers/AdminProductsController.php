<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminProductsController extends Controller
{
    public function create(){
        return view('panel.products.create', [
            'products' => Product::all()
        ]);
    }

    public function show(Product $product){
        return view('panel.products.show', [
            'product' => $product
        ]);
    }

    public function update(Product $product){
        $attributes = request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $product->update($attributes);

        return redirect('/admin/products')->with('dialogMessage', 'Product has been updated');
    }
}
