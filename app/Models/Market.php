<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_name', 'slug', 'description', 'address', 'city',
        'operating_days', 'opening_time', 'closing_time',
        'latitude', 'longitude', 'map_provider', 'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (Market $market) {
            if (empty($market->slug)) {
                $market->slug = Str::slug($market->market_name);
            }
        });
    }

    public function farmers()
    {
        return $this->belongsToMany(User::class, 'market_farmer', 'market_id', 'farmer_id')
                    ->withTimestamps();
    }
    public function orders()      { return $this->hasMany(Order::class); }
    public function pickupSlots() { return $this->hasMany(PickupSlot::class); }

    public function isActive(): bool { return $this->status === 'active'; }

    public function getRouteKeyName(): string { return 'slug'; }
}
