<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'thumbnail'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category() {
        return $this->belongsToMany('App\Models\Category')->using('App\Models\CategoryPivot');
    }

    public function carts() {
        return $this->belongsToMany('App\Models\Cart')->using('App\Models\CartPivot');
    }

}
