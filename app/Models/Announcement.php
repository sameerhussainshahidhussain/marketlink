<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'message', 'type', 'status', 'published_at', 'created_by',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function creator() { return $this->belongsTo(User::class, 'created_by'); }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }
}
