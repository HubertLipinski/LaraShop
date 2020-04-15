<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products() {
        return $this->hasMany('App\Models\Product');
    }

    public function cart() {
        return $this->hasOne('App\Models\Cart', 'user_id');
    }

    public function payment() {
        return$this->hasMany('App\Models\PaymentHistory', 'user_id');
    }

    public function address() {
        return $this->hasMany('App\Models\SavedAddress');
    }

    public function isAdmin() {
        return $this->role()->where('name', 'admin')->exists();
    }

    public function boughtItems() {
        $successfulPayments = Order::whereHas('payment', function($item){
            $item->where('order_status','SUCCESS');
            $item->where('user_id', 1);
        })->get();

        $boughtItems = 0;
        foreach ($successfulPayments as $payment) {
            $boughtItems += $payment->cart->items()->count();
        }
        return $boughtItems;
    }

    public function getAvatar() {
        $url = Storage::url($this->avatar);
        return $url;
    }
}
