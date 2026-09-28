<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role',
        'status',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isFarmer(): bool
    {
        return $this->role === 'farmer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }


    public function farmerProfile()
    {
        return $this->hasOne(FarmerProfile::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function farmerOrders()
    {
        return $this->hasMany(Order::class, 'farmer_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'farmer_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    public function pickupSlots()
    {
        return $this->hasMany(PickupSlot::class, 'farmer_id');
    }

    public function favoriteFarmers()
    {
        return $this->belongsToMany(User::class, 'favorite_farmers', 'customer_id', 'farmer_id')
                    ->withTimestamps();
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorite_products', 'customer_id', 'product_id')
                    ->withTimestamps();
    }

    public function markets()
    {
        return $this->belongsToMany(Market::class, 'market_farmer', 'farmer_id', 'market_id')
                    ->withTimestamps();
    }
}
