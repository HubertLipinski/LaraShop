<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedAddress extends Model
{
    protected $table = 'user_saved_addresses';

    protected $fillable = [
        'user_id',
        'display_name',
        'name',
        'surname',
        'address',
        'zip_code',
        'city',
        'country',
        'number',
    ];

    protected $attributes = [
        'country' => 'Polska',
        'display_name' => 'Bez Nazwy',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
