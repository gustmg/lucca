<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $primaryKey='entry_id';
    protected $with=[ 'user','brand','entry_products'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'entry_user_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'entry_brand_id');
    }

    public function entry_products(){
        return $this->hasMany('App\Models\ProductEntry', 'entry_id');
    }
}
