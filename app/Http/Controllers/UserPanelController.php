<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{
    private $categories;

    /**
     * UserPanelController constructor.
     * @param Category $categoryModel
     */
    public function __construct(Category $categoryModel)
    {
        $this->middleware('auth');
        $this->categories = $categoryModel;
    }

    public function sell()
    {
        $categories = $this->categories
            ->all();
        return view('layouts.products.sellProduct')
            ->with(['categories' => $categories]);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('layouts.user.profile')
            ->with([
                'user' => $user,
                'addresses' => $user->address,
                'product_number' => $user->products->count(),
                'items_bought' => $user->boughtItems()
            ]);
    }

    public function items()
    {
        return view('layouts.user.items');
    }

    public function favourites()
    {
        return view('layouts.user.favourites');
    }

    public function settings()
    {
        return view('layouts.user.settings');
    }

    public function messages()
    {
        return view('layouts.user.messages');
    }
}
