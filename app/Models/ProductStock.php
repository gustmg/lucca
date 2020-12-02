<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $table='product_stock';

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function color() {
        return $this->belongsTo('App\Models\Color');
    }

    public function size() {
        return $this->belongsTo('App\Models\Size');
    }
}
