<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return false;
    }
}
