<?php

namespace App\Models\Delegation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class DelegationLocation extends Model
{
    use HasFactory;

    protected $table = 'delegation_location';

    protected $fillable = [
        'location_id',
        'delegation_id',
        'created_at',
        'updated_at'
    ];

    public function delegation(): BelongsTo
    {
        return $this->belongsTo('App\Models\Delegation\Delegation', 'delegation_id','id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo('App\Models\Location\Location', 'location_id','id');
    }


}
