<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_id',
        'farmer_id',
        'market_id',
        'pickup_slot_id',
        'pickup_date',
        'pickup_start_time',
        'pickup_end_time',
        'subtotal',
        'total_amount',
        'payment_method',
        'order_status',
        'cutoff_time',
        'notes',
    ];

    protected $casts = [
        'pickup_date'  => 'date',
        'cutoff_time'  => 'datetime',
        'subtotal'     => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    const STATUS_PLACED    = 'placed';
    const STATUS_ACCEPTED  = 'accepted';
    const STATUS_DECLINED  = 'declined';
    const STATUS_READY     = 'ready_for_pickup';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    const VALID_TRANSITIONS = [
        'placed'           => ['accepted', 'declined', 'cancelled'],
        'accepted'         => ['ready_for_pickup', 'cancelled'],
        'declined'         => [],
        'ready_for_pickup' => ['completed'],
        'completed'        => [],
        'cancelled'        => [],
    ];

    public function canTransitionTo(string $newStatus): bool
    {
        $allowed = self::VALID_TRANSITIONS[$this->order_status] ?? [];
        return in_array($newStatus, $allowed);
    }

    public function isPastCutoff(): bool
    {
        if (!$this->cutoff_time) {
            return false;
        }

        return Carbon::now()->greaterThanOrEqualTo($this->cutoff_time);
    }

    public function isModifiable(): bool
    {
        return $this->order_status === 'placed' && !$this->isPastCutoff();
    }

    public function isCancellable(): bool
    {
        $cancelableStatuses = ['placed', 'accepted'];
        return in_array($this->order_status, $cancelableStatuses) && !$this->isPastCutoff();
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function pickupSlot()
    {
        return $this->belongsTo(PickupSlot::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public static function generateOrderNumber(): string
    {
        $suffix = strtoupper(substr(uniqid(), -6));
        return 'ML-' . $suffix . '-' . date('Ymd');
    }

    public function scopeForCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeForFarmer($query, $farmerId)
    {
        return $query->where('farmer_id', $farmerId);
    }
}
