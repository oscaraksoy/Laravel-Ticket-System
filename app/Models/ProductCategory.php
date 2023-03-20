<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public static function getParents(){
        return ProductCategory::all()->whereNull('parent_id');
    }

    public function parent(){
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
