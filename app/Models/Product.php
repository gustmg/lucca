<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $with = ['product_category', 'product_gender', 'product_stock'];

    public function product_category() {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }

    public function product_gender() {
        return $this->belongsTo('App\Models\ProductGender', 'product_gender_id');
    }

    public function product_stock() {
        return $this->hasMany('App\Models\ProductStock', 'product_id');
    }
}
