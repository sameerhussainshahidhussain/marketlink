<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'business_name', 'contact_person', 'address',
        'description', 'location_name', 'latitude', 'longitude',
        'map_provider', 'approval_status',
    ];

    public function user()   { return $this->belongsTo(User::class); }
    public function markets() {
        return $this->belongsToMany(Market::class, 'market_farmer', 'farmer_id', 'market_id', 'user_id')
                    ->withTimestamps();
    }

    public function isApproved(): bool  { return $this->approval_status === 'approved'; }
    public function isPending(): bool   { return $this->approval_status === 'pending'; }
    public function isSuspended(): bool { return $this->approval_status === 'suspended'; }
}
