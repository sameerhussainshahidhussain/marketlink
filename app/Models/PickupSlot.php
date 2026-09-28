<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PickupSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id', 'market_id', 'pickup_date', 'start_time', 'end_time',
        'max_orders', 'current_orders', 'cutoff_time', 'status',
    ];

    protected $casts = [
        'pickup_date'  => 'date',
        'cutoff_time'  => 'datetime',
    ];

    public function farmer() { return $this->belongsTo(User::class, 'farmer_id'); }
    public function market() { return $this->belongsTo(Market::class); }
    public function orders() { return $this->hasMany(Order::class); }

    public function isBookable(): bool
    {
        return $this->status === 'available'
            && $this->current_orders < $this->max_orders
            && Carbon::now()->lessThan($this->cutoff_time);
    }

    public function isFull(): bool
    {
        return $this->current_orders >= $this->max_orders;
    }

    public function isPastCutoff(): bool
    {
        return Carbon::now()->greaterThanOrEqualTo($this->cutoff_time);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')
                     ->where('current_orders', '<', \DB::raw('max_orders'))
                     ->where('cutoff_time', '>', Carbon::now());
    }
}
