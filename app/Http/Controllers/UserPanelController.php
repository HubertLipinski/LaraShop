<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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

        return view('layouts.user.profile');
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
