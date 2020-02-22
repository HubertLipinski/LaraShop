<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function items() {
        return $this->belongsToMany('App\Models\Product')
            ->using('App\Models\CartPivot')
            ->withPivot([
                'cart_id',
                'product_id'
            ]);
    }
}
