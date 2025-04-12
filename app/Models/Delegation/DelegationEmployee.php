<?php

namespace App\Models\Delegation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class DelegationEmployee extends Model
{

    protected $table = 'delegation_employees';

    protected $fillable = [
        'employee_id',
        'location_id',
        'created_at',
        'updated_at'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'employee_id', 'id');
    }

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo('App\Models\Delegation\Deleta', 'location_id', 'id');
    }

}
