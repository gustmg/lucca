<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $with = ['category', 'gender'];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function gender() {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }
}
