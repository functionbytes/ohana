<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class LocationCustomer extends Model
{
    use HasFactory;

    protected $table = 'location_customers';

    protected $fillable = [
        'customer_id',
        'location_id',
        'created_at',
        'updated_at'
    ];

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function scopeDisabled($query)
    {
        return $query->where('available', 1);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo('App\Models\Location\Location', 'location_id', 'id');
    }

}
