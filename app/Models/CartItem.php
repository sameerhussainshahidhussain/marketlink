<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'farmer_id', 'quantity', 'price'];

    public function cart()    { return $this->belongsTo(Cart::class); }
    public function product() { return $this->belongsTo(Product::class); }
    public function farmer()  { return $this->belongsTo(User::class, 'farmer_id'); }

    public function getSubtotalAttribute(): float
    {
        return $this->price * $this->quantity;
    }
}
