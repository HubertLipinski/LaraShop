<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductList extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request) {
        $paginate = 3;
        if ($category = $request->get('category')) {
            $products = Category::where('name',$category)->first()->products()->paginate($paginate);
            $products->withPath(route('withCategory', $category));
        } else $products = Product::paginate($paginate);

        return view('layouts.products.productsIndex')
            ->with([
                'products' => $products,
                'categories' => Category::all()
            ]);
    }
}
