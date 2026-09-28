<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RestockAlertNotification extends Notification
{
    use Queueable;

    public function __construct(public Product $product)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'        => "Produce Restocked: {$this->product->name}",
            'message'      => "{$this->product->name} by {$this->product->farmer->name} is back in stock with {$this->product->stock_quantity} {$this->product->unit}s available!",
            'product_id'   => $this->product->id,
            'product_slug' => $this->product->slug,
            'action_url'   => route('products.show', $this->product),
            'type'         => 'restock_alert',
        ];
    }
}
