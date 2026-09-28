<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $user->isAdmin() || $user->id === $order->customer_id || $user->id === $order->farmer_id;
    }

    public function cancel(User $user, Order $order): bool
    {
        return $user->id === $order->customer_id && $order->isCancellable();
    }

    public function manage(User $user, Order $order): bool
    {
        return $user->isAdmin() || $user->id === $order->farmer_id;
    }
}
