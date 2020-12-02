<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $with = ['category', 'gender', 'product_colors', 'product_sizes', 'product_stock'];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'product_category_id');
    }

    public function gender() {
        return $this->belongsTo('App\Models\Gender', 'product_gender_id');
    }

    public function product_colors() {
        return $this->belongsToMany('App\Models\Color', 'product_colors', 'product_id', 'color_id');
    }

    public function product_sizes() {
        return $this->belongsToMany('App\Models\Size', 'product_sizes', 'product_id', 'size_id');
    }

    public function product_stock() {
        return $this->hasMany('App\Models\ProductStock', 'product_id');
    }
}
