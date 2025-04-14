<?php

namespace App\Models\Delegation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class DelegationLocationCallcenter extends Model
{
    use HasFactory;

    protected $table = 'delegation_location_commercial_employees';

    protected $fillable = [
        'employee_id',
        'leader_id',
        'created_at',
        'updated_at'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'employee_id','id');
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'leader_id','id');
    }

}
