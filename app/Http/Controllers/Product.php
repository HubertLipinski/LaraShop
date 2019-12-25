<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as ProductModel;
use Illuminate\Support\Facades\Auth;

class Product extends Controller
{
    private $product;

    /**
     * Product constructor.
     * @param ProductModel $model
     */
    public function __construct(ProductModel $model)
    {
        $this->product = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ProductModel $product
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singleProduct = $this->product->findOrFail($id);
        abort_unless(Auth::user()->can('view', $singleProduct), 401);
        dd($singleProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $singleProduct = $this->product->findOrFail($id);
        abort_unless(Auth::user()->can('update', $singleProduct), 401);
        //update product
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singleProduct = $this->product->findOrFail($id);
        abort_unless(Auth::user()->can('delete', $singleProduct), 401);
    }
}
