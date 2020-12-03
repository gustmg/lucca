<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntry extends Model
{
    use HasFactory;
    protected $table='product_entries';
    public $timestamps = true;
    public $with=['product'];

    public function entry() {
        return $this->belongsTo('App\Models\Entry');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function color() {
        return $this->belongsTo('App\Models\Color');
    }

    public function size() {
        return $this->belongsTo('App\Models\Size');
    }
}
