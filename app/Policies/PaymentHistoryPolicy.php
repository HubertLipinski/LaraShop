<?php

namespace App\Policies;

use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentHistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any payment histories.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the payment history.
     *
     * @param User $user
     * @param PaymentHistory $paymentHistory
     * @return mixed
     */
    public function view(User $user, PaymentHistory $paymentHistory)
    {
        return $user->id === $paymentHistory->user_id;
    }

    /**
     * Determine whether the user can create payment histories.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the payment history.
     *
     * @param User $user
     * @param  \App\PaymentHistory  $paymentHistory
     * @return mixed
     */
    public function update(User $user, PaymentHistory $paymentHistory)
    {
        return $user->id === $paymentHistory->user_id;
    }

    /**
     * Determine whether the user can delete the payment history.
     *
     * @param User $user
     * @param  \App\PaymentHistory  $paymentHistory
     * @return mixed
     */
    public function delete(User $user, PaymentHistory $paymentHistory)
    {
        //
    }

    /**
     * Determine whether the user can restore the payment history.
     *
     * @param User $user
     * @param  \App\PaymentHistory  $paymentHistory
     * @return mixed
     */
    public function restore(User $user, PaymentHistory $paymentHistory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the payment history.
     *
     * @param User $user
     * @param  \App\PaymentHistory  $paymentHistory
     * @return mixed
     */
    public function forceDelete(User $user, PaymentHistory $paymentHistory)
    {
        //
    }
}
