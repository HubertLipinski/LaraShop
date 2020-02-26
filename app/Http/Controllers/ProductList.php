<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Monolog\Logger;
use function Composer\Autoload\includeFile;

class ProductList extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $products = Product::paginate(3);
        return view('layouts.products.productsIndex')->with(['products'=>$products]);
    }

}
