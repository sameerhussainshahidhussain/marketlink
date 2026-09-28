<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyStockItem extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'product_id', 'default_quantity', 'default_price'];

    public function template() { return $this->belongsTo(WeeklyStockTemplate::class); }
    public function product()  { return $this->belongsTo(Product::class); }
}
