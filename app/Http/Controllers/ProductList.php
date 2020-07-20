<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Monolog\Logger;
use function Composer\Autoload\includeFile;

class ProductList extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {

        $paginate = 3;
        if ($category = $request->get('category')) {
            $products = Category::where('name',$category)->first()->products()->paginate($paginate);
            $products->withPath(route('withCategory', $category));
        } else $products = Product::paginate($paginate);


//        dd($products);

        return view('layouts.products.productsIndex')
            ->with([
                'products' => $products,
                'categories' => Category::all()
            ]);
    }

}
