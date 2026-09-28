<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyStockTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['farmer_id', 'name', 'day_of_week', 'status'];

    public function farmer() { return $this->belongsTo(User::class, 'farmer_id'); }
    public function items()  { return $this->hasMany(WeeklyStockItem::class, 'template_id'); }
}
