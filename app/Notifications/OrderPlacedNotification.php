<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'        => 'New Pre-Order Placed: #' . $this->order->order_number,
            'message'      => "Customer {$this->order->customer->name} reserved Rs. " . number_format($this->order->total_amount, 2) . " for pickup on " . $this->order->pickup_date->format('M d, Y') . ".",
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'action_url'   => route('farmer.orders.show', $this->order),
            'type'         => 'order_placed',
        ];
    }
}
