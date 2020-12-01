<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $primaryKey = 'brand_id';
    protected $with = ['brand_categories', 'brand_products'];

    public function brand_categories() {
        return $this->hasMany('App\Models\Category', 'category_brand_id');
    }

    public function brand_products() {
        return $this->hasMany('App\Models\Product', 'product_brand_id');
    }
}
