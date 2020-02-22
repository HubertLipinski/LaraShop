<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $product = Product::find(1);
        return view('layouts.cart.cart')->with(['product'=>$product]);
    }
}
