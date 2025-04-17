<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Commission extends Model
{
    protected $fillable = [
        'commissionable_id',
        'commissionable_type',
        'assigned_by',
        'type',
        'amount',
        'description',
        'commission_date'
    ];

    public function commissionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function assignedBy() : BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'assigned_by');
    }
}