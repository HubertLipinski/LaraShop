<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavourite extends Model
{
    protected $table = 'user_favourites';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function product() {
        return $this->hasMany('App\Models\Product', 'id', 'product_id');
    }
}
