<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteFarmer extends Model
{
    protected $fillable = ['customer_id', 'farmer_id'];

    public function customer() { return $this->belongsTo(User::class, 'customer_id'); }
    public function farmer()   { return $this->belongsTo(User::class, 'farmer_id'); }
}
