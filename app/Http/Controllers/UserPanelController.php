<?php

namespace App\Http\Controllers;

use App\Category;
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

    public function sellView() {
        $categories = $this->categories
            ->all();

        return view('layouts.products.sellProduct')
            ->with(['categories' => $categories]);
    }
}
