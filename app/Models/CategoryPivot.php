<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryPivot extends Pivot
{
    protected $table = 'category_product';

}
