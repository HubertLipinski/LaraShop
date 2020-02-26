<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    private $cart;
    private $product;

    /**
     * CartController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    public function index() {
        $products = Auth::user()->cart->items;
        return view('layouts.cart.cart')->with(['products'=>$products]);
    }

    // todo dodac request validation
    public function addToCart(Request $request) {
        $id = $request->id;
        $product = $this->product->findOrFail($id);
        $cart = Auth::user()->cart;
        $in_cart = $product->carts->where('user_id', Auth::user()->id);
        if (count($in_cart) == 0) {
            $cart->items()
                ->attach(
                    $product,
                    ["qty"=>1]
                );
            return back()->with(['success'=>'Pomyślnie dodano do koszyka!']);
        } else {
            return back()->with(['message'=>'Masz już ten przedmiot w koszyku!']);
        }
    }
}
