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

    public function cart() {
        return $this->belongsTo('App\Models\Cart')->withTrashed();
    }

    public function address() {
        return $this->belongsTo('App\Models\SavedAddress', 'user_address_id');
    }

    public function payment() {
        return $this->belongsTo('App\Models\PaymentHistory', 'payment_histories_id');
    }
}
