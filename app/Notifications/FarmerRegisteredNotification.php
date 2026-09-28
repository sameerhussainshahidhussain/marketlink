<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FarmerRegisteredNotification extends Notification
{
    use Queueable;

    public function __construct(public User $farmer)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $biz = $this->farmer->farmerProfile->business_name ?? 'Farm Stall';
        return [
            'title'      => "New Farmer Registration: {$this->farmer->name}",
            'message'    => "{$this->farmer->name} registered '{$biz}' and is awaiting admin approval.",
            'farmer_id'  => $this->farmer->id,
            'action_url' => route('admin.farmers.pending'),
            'type'       => 'farmer_registered',
        ];
    }
}
