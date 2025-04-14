<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use App\Traits\HasUid;
use Carbon\Carbon;

class Contract extends Model
{
    use LogsActivity , HasUid;

	protected $table = 'contracts';

    protected $fillable = [
        'uid',
        'number',
        'reference',
        'amount',
        'installment',
        'installment_amount',
        'notes',
        'iban',
        'entity_id',
        'financing_id',
        'method_id',
        'status_id',
        'statement_id',
        'note_id',
        'customer_id',
        'from_at',
        'to_at',
        'contract_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults() ->logOnlyDirty() ->logFillable() ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }
    public function getVisitAtFormattedAttribute()
    {
        return $this->visit_at ? Carbon::parse($this->visit_at)->format('Y-m-d') : null;
    }
    public static function getNextNumber()
    {
        $lastNumber = self::max('number');
        return $lastNumber ? $lastNumber + 1 : 1;
    }

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeDescending($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeUid($query ,$uid)
    {
        return $query->where('uid', $uid)->first();
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo('App\Models\Contract\ContractEntitiy', 'entity_id');
    }
    public function financing(): BelongsTo
    {
        return $this->belongsTo('App\Models\Contract\ContractFinancing', 'financing_id');
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo('App\Models\Contract\ContractMethod', 'method_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo('App\Models\Contract\ContractStatuses', 'status_id');
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo('App\Models\Sta\Note', 'note_id');
    }
    public function statement(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\Statement', 'statement_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }


}

