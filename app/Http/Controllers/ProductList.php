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

    /**
     * Function that return link to the image
     * @param $id
     * @param $index
     * @return mixed
     */
    public function getImagesLink($id, $index) {
        $product = Product::findOrFail($id);
        $filename = json_decode($product->thumbnail);
        if (sizeof($filename) == 1 || $index >= sizeof($filename)) {
            $index = 0;
        }
        $exists = Storage::exists($filename[$index]);
        if (!$exists) abort(404);
        $url = Storage::url($filename[$index]);
        return $url;
    }
}
