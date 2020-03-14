<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_address_id',
        'cart_id',
        'payment_histories_id',
        'value',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function cart() {
        return $this->belongsTo('App\Models\Cart')->withTrashed();
    }

    public function payment() {
        return $this->hasOne('App\Models\PaymentHistory');
    }
}
