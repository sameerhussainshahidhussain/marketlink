<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order, public string $status)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $statusLabel = ucwords(str_replace('_', ' ', $this->status));
        $farmerName = $this->order->farmer->farmerProfile->business_name ?? $this->order->farmer->name;

        return [
            'title'        => "Order #{$this->order->order_number} is now {$statusLabel}",
            'message'      => "{$farmerName} updated your order to '{$statusLabel}'. Pickup Date: " . $this->order->pickup_date->format('M d, Y') . " at {$this->order->market->market_name}.",
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'status'       => $this->status,
            'action_url'   => route('customer.orders.show', $this->order),
            'type'         => 'order_status_updated',
        ];
    }
}
