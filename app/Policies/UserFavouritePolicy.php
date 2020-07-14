<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserFavourite;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserFavouritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user favourites.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the user favourite.
     *
     * @param User $user
     * @param  UserFavourite  $userFavourite
     * @return mixed
     */
    public function view(User $user, UserFavourite $userFavourite)
    {
        return $user->id === $userFavourite->user_id;
    }

    /**
     * Determine if user can view all favourite.
     *
     * @param User $user
     * @return bool
     */
    public function viewAll(User $user) {
        return false;
    }

    /**
     * Determine whether the user can create user favourites.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the user favourite.
     *
     * @param User $user
     * @param  UserFavourite  $userFavourite
     * @return mixed
     */
    public function update(User $user, UserFavourite $userFavourite)
    {
        return $user->id === $userFavourite->user_id;
    }

    /**
     * Determine whether the user can delete the user favourite.
     *
     * @param User $user
     * @param  UserFavourite  $userFavourite
     * @return mixed
     */
    public function delete(User $user, UserFavourite $userFavourite)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the user favourite.
     *
     * @param User $user
     * @param  UserFavourite  $userFavourite
     * @return mixed
     */
    public function restore(User $user, UserFavourite $userFavourite)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the user favourite.
     *
     * @param User $user
     * @param  UserFavourite  $userFavourite
     * @return mixed
     */
    public function forceDelete(User $user, UserFavourite $userFavourite)
    {
        return false;
    }

    /**
     * Determine whether the user can check if favourite exists or not.
     *
     * @param User $user
     * @return bool
     */
    public function checkIfExists(User $user)
    {
        return true;
    }
}
