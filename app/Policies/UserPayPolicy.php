<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPay;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPay  $userPay
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, UserPay $userPay)
    {
        return $user->id === $userPay->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPay  $userPay
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, UserPay $userPay)
    {
        return $user->id === $userPay->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPay  $userPay
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, UserPay $userPay)
    {
        return $user->id === $userPay->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPay  $userPay
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, UserPay $userPay)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPay  $userPay
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, UserPay $userPay)
    {
        return true;
    }
}
