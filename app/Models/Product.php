<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_category_id'];

    public static function groupByProductCategory(){
        $parentCategories = Product::with('productCategory')
            ->get()
            ->groupBy('productCategory.parent.name');

        $categoriesWithSubcategories = [];

        foreach($parentCategories as $parentCategory => $products){
            $categoriesWithSubcategories[$parentCategory] = $products->groupBy('productCategory.name');
        }

        return $categoriesWithSubcategories;
    }

    private static function subAndParentCategoryJoinBuilder(){
        return DB::table('products')
            ->join('product_categories as subCategory', 'subCategory.id', '=', 'products.product_category_id')
            ->join('product_categories as parentCategory', 'parentCategory.id', '=', 'subCategory.parent_id');
    }

    public static function productCountsByCategory(){
        return self::subAndParentCategoryJoinBuilder()
                ->select([DB::raw('COUNT(*) as count'), 'parentCategory.name'])
                ->groupBy('parentCategory.name')->get();
    }

    public static function paginateByParentCategory(ProductCategory $productCategory){
        return self::subAndParentCategoryJoinBuilder()
            ->where('parentCategory.id', '=', $productCategory->id)
            ->select(['products.name as product_name', 'parentCategory.name as parent_category_name', 'subCategory.name as subcategory_name'])
            ->paginate(10);
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }
}
