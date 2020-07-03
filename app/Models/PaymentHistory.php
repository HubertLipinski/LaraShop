<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'payment_histories';

    protected $fillable = [
        'user_id',
        'payment_providers_id',
        'payment_provider_order_id',
        'order_status',
        'order_hash'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function provider() {
        return $this->hasMany('App\Models\PaymentProvider', 'id', 'payment_providers_id');
    }
}
