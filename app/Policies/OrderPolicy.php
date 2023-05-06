<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->role === User::ROLE_ADMIN;
    }

    public function create(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function update(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    public function delete(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    public function restore(User $user, Order $order)
    {
        return false;
    }

    public function forceDelete(User $user, Order $order)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function reserv(User $user)
    {
        return true;
    }

    public function confirmRent(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function confirmPayment(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function rent(User $user, Order $order)
    {
        return $user->role === User::ROLE_ADMIN  || $user->id === $order->user_id;
    }

    public function finish(User $user, Order $order)
    {
        return $user->role === User::ROLE_ADMIN || $user->id === $order->user_id;
    }
}
