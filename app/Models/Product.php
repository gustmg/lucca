<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $with = ['category', 'gender', 'product_colors'];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'product_category_id');
    }

    public function gender() {
        return $this->belongsTo('App\Models\Gender', 'product_gender_id');
    }


    //TODO : Create product_color table relation
    public function product_colors() {
        return $this->hasMany('App\Models\Color');
    }
}
