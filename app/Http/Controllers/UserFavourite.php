<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFavourite\CreateUserFavourite;
use App\Http\Requests\UserFavourite\UpdateUserFavourite;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Models\UserFavourite as UserFavouriteModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserFavourite extends Controller
{
    private $userFav;

    /**
     * UserFavourite constructor.
     * @param UserFavouriteModel $userFavourite
     */
    public function __construct(UserFavouriteModel $userFavourite)
    {
        $this->middleware('auth');
        $this->userFav = $userFavourite;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $user = Auth::user();
        return view('layouts.user.favourites')
            ->with([
                'favourite' => $user->favourites
            ]);
    }

    public function indexAll()
    {
        abort_if(Auth::user()->can('viewAny', UserFavouriteModel::class), 401);
        return $this->userFav->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserFavourite $request
     * @return JsonResponse
     */
    public function store(CreateUserFavourite $request)
    {
        $user = Auth::user();
        abort_unless($user->can('create', $this->userFav), 401);
        $user->favourites()->firstOrcreate($request->validated());
        return response()->json(__('Pomyślnie dodano do ulubionych!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $userFavourite = $this->userFav->firstOrFail($id);
        abort_unless(Auth::user()->can('view', $userFavourite), 401);
        return $userFavourite;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserFavourite $request
     * @param int $id
     * @return void
     */
    public function update(UpdateUserFavourite $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $userFavourite = $this->userFav->where('product_id', $id)->firstOrFail();
        abort_unless(Auth::user()->can('delete', $userFavourite), 401);
        $this->userFav->destroy($userFavourite->id);
        return response()->json(__('Pmyślnie usunięto ulubione!'));
    }
}
