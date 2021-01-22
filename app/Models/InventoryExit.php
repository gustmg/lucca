<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryExit extends Model
{
    use HasFactory;
    protected $table='exits';
    protected $primaryKey='exit_id';
    protected $with=[ 'user','brand','exit_products'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'entry_user_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'entry_brand_id');
    }

    public function exit_products(){
        return $this->hasMany('App\Models\ProductExit', 'exit_id');
    }
}
