<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductsController extends Controller
{
    public function create(ProductCategory $productCategory){
        return view("product.create", [
            'productCategory' => $productCategory,
            'products' => Product::paginateByParentCategory($productCategory),
        ]);
    }
}
