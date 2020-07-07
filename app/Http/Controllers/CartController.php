<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDeleteItemRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $this->middleware(['auth', 'verified']);
        $this->product = $product;
    }

    public function index()
    {
        $products = Auth::user()->cart->items;
        $addresses = Auth::user()->address;

        return view('layouts.cart.cart')
            ->with([
                'products' => $products,
                'addresses' => $addresses,
            ]);
    }

    // todo dodac request validation
    public function addToCart(Request $request)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request) : JsonResponse
    {
        $id = $request->get('id');
        $value = $request->get('value');
        $product = Auth::user()->cart->items();
        $product->updateExistingPivot($id, ['qty'=>$value]);
        return response()->json('Rekord został pomyślnie zaktualizowany!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CartDeleteItemRequest $request
     * @return JsonResponse
     */
    public function destroy(CartDeleteItemRequest $request) : JsonResponse
    {
        $cart = Auth::user()->cart;
        $data = $request->validated();
        $singleProduct = $cart->items()->findOrFail($data['id']);
//       abort_unless(Auth::user()->can('delete', $singleProduct), 401);

        $cart->items()->detach($singleProduct);
        return response()->json('Pomyślnie usunięto przedmiot!');
    }
}
