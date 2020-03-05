<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'payment_histories';

    protected $fillable = [
        'user_id',
        'payment_provider_order_id',
        'order_status'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
