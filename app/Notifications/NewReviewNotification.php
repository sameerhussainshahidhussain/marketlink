<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReviewNotification extends Notification
{
    use Queueable;

    public function __construct(public Review $review)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'      => "New {$this->review->rating}★ Review from {$this->review->customer->name}",
            'message'    => "Customer review: \"{$this->review->comment}\"",
            'review_id'  => $this->review->id,
            'rating'     => $this->review->rating,
            'action_url' => route('farmer.reviews.index'),
            'type'       => 'new_review',
        ];
    }
}
