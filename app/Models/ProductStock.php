<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $table = 'product_stock';
    protected $with = ['product_color'];

    public function product_color() {
        return $this->belongsTo('App\Models\ProductColor', 'product_color_id');
    }
}
