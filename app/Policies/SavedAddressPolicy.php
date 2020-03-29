<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SavedAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class SavedAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any saved addresses.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the saved addresses.
     *
     * @param User $user
     * @param SavedAddress $savedAddress
     * @return mixed
     */
    public function view(User $user, SavedAddress $savedAddress)
    {
        //
    }

    /**
     * Determine whether the user can create saved addresses.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the saved addresses.
     *
     * @param User $user
     * @param SavedAddress $savedAddress
     * @return mixed
     */
    public function update(User $user, SavedAddress $savedAddress)
    {
        return $user->id === $savedAddress->user_id;
    }

    /**
     * Determine whether the user can delete the saved addresses.
     *
     * @param User $user
     * @param SavedAddress $savedAddress
     * @return mixed
     */
    public function delete(User $user, SavedAddress $savedAddress)
    {
        return $user->id === $savedAddress->user_id;
    }

    /**
     * Determine whether the user can restore the saved addresses.
     *
     * @param User $user
     * @param SavedAddress $savedAddress
     * @return mixed
     */
    public function restore(User $user, SavedAddress $savedAddress)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the saved addresses.
     *
     * @param User $user
     * @param SavedAddress $savedAddress
     * @return mixed
     */
    public function forceDelete(User $user, SavedAddress $savedAddress)
    {
        return false;
    }
}
