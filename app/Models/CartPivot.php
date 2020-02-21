<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CartPivot extends Pivot
{
    protected $table = 'cart_product';
}
