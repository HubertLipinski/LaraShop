<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $table = 'carts';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function items() {
        return $this->belongsToMany('App\Models\Product', 'cart_product')
            ->using('App\Models\CartPivot')
            ->withPivot([
                'cart_id',
                'product_id',
                'qty'
            ]);
    }
}
