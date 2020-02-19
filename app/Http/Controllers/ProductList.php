<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Monolog\Logger;

class ProductList extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $products = Product::paginate(3);
        return view('layouts.products.productsIndex')->with(['products'=>$products]);
    }

    /**
     * @param $id
     */
    public function getImages($id, $index) {
        $product = Product::findOrFail($id);
        $filename = json_decode($product->thumbnail);

        $exists = Storage::exists($filename[$index]);
        if (!$exists) abort(404);
        $image = Storage::get($filename[$index]);
        $extension = \File::extension($filename[$index]);

        return response($image, 200)
            ->withHeaders(["Content-type: image/".$extension]);

    }
}
