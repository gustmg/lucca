<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryEntry extends Model
{
    use HasFactory;
    protected $table = 'inventory_entries';
    protected $primaryKey = 'inventory_entry_id';
    protected $with = ['products'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_entries', 'inventory_entry_id', 'product_id')->withPivot('product_entry_amount', 'product_unit_cost');
    }
}
