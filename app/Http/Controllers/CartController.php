<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $product = Product::findOrFail(1);
        return view('layouts.cart.cart')->with(['product'=>$product]);
    }
}
