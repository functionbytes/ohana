<?php

namespace App\Models\Note;

use App\Traits\HasUid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Note extends Model
{
    use LogsActivity , HasUid;

	protected $table = 'notes';

    protected $fillable = [
        'uid',
        'number',
        'parish',
        'schedule_id',
        'customer_id',
        'status_id',
        'notes',
        'gps',
        'gps_longitude',
        'gps_latitude',
        'visit_at',
        'created_at',
        'created_at',
        'updated_at'
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults() ->logOnlyDirty() ->logFillable() ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }
    public function getGpsCoordinatesAttribute(): ?string
    {
        if ($this->gps == 1 && $this->gps_latitude && $this->gps_longitude) {
            return "{$this->gps_latitude}, {$this->gps_longitude}";
        }

        return null;
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

    public function status(): BelongsTo
    {
        return $this->belongsTo('App\Models\Note\NoteStatuses', 'status_id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo('App\Models\Note\NoteSchedule', 'schedule_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function teleoperator(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'teleoperator_id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany('App\Models\Note\NoteHistorie');
    }
    public function statement()
    {
        return $this->hasOne('App\Models\Statement\Statement');
    }

}

