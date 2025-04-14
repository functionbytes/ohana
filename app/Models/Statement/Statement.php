<?php

namespace App\Models\Statement;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use App\Traits\HasUid;
use Carbon\Carbon;

class Statement extends Model
{
    use LogsActivity , HasUid;

	protected $table = 'statements';

    protected $fillable = [
        'uid',
        'number',
        'reference',
        'iban',
        'notes',
        'phone',
        'cellphone',
        'amount',
        'installment',
        'installment_amount',
        'iban',
        'payment_id',
        'commercial_id',
        'employment_id',
        'relationship_id',
        'schedule_id',
        'method_id',
        'status_id',
        'note_id',
        'accessorie_id',
        'cream_id',
        'marital_id',
        'customer_id',
        'housing_id',
        'total',
        'delivery_at',
        'time_at',
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
        return $this->visit_at ? Carbon::parse($this->delivery_at)->format('Y-m-d') : null;
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

    public function payment(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementPayment', 'payment_id');
    }
    public function employment(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementEmployment', 'employment_id');
    }

    public function commercial(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementEmployment', 'commercial_id');
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementRelationship', 'relationship_id');
    }
    public function schedule(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementSchedule', 'schedule_id');
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementMethod', 'method_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementStatuse', 'status_id');
    }
    public function note(): BelongsTo
    {
        return $this->belongsTo('App\Models\Note\Note', 'note_id');
    }

    public function accessorie(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementAccessorie', 'accessorie_id');
    }

    public function cream(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementCream', 'cream_id');
    }

    public function marital(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementMarital', 'marital_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function housing(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementHousing', 'housing_id');
    }


    public function annotations(): HasMany
    {
        return $this->hasMany('App\Models\Statement\StatementAnnotation');
    }
}

