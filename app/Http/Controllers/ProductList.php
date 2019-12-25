<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductList extends Controller
{
    public function index() {
        $products = Product::all();
        return view('layouts.items')->with(['products'=>$products]);
    }
}
