<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
    //optional todo add multiple categories insert
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $category = Category::findOrFail($data['category']);

        $files = [];
        foreach($data['images'] as $image) {
            $path = Storage::put('ProductsPhotos/'.$request->user()->id, $image, 'public');
            array_push($files, $path);
        }

        $created = $this->product->create(
            [
                'user_id' => Auth::id(),
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'thumbnail' => json_encode($files),
            ]);
        $created->category()->attach($category->id);

        return back()->with(['success'=>'Pomyślnie dodano przedmiot!']);
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
//        abort_unless(Auth::user()->can('view', $singleProduct), 401);
        $categories = $singleProduct->category()
            ->pluck('name')
            ->toArray();
        return view('layouts.products.product')
            ->with([
                    'product'=>$singleProduct,
                    'categories'=>$categories,
                ]);
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
