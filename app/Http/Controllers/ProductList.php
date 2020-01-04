<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductList extends Controller
{
    public function index() {
        $products = Product::paginate(3);
        return view('layouts.products.productsIndex')->with(['products'=>$products]);
    }
}
