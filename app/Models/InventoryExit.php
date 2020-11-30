<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryExit extends Model
{
    use HasFactory;
    protected $table = 'inventory_exits';
    protected $primaryKey = 'inventory_exits_id';
    protected $with = ['products'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_exits', 'inventory_exit_id', 'product_id')->withPivot('product_exit_amount');
    }
}
