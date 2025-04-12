<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class LocationEmployee extends Model
{
    use HasFactory;

    protected $table = 'location_employees';

    protected $fillable = [
        'employee_id',
        'enterprise_id',
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

    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'employee_id', 'id');
    }

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo('App\Models\Enterprise\Enterprise', 'enterprise_id', 'id');
    }

}
