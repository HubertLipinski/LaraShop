<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'product_id'
    ];

    public function products() {
        return $this->belongsToMany('App\Models\Product')
            ->using('App\Models\CategoryPivot')
            ->withPivot([
                'product_id',
                'category_id'
            ]);
    }
}
