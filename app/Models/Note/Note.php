<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Note extends Model
{
    use LogsActivity;

	protected $table = 'notes';

    protected $fillable = [
        'uid',
        'number',
        'customer_id',
        'status_id',
        'notes',
        'created_at',
        'updated_at'
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults() ->logOnlyDirty() ->logFillable() ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
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

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function histories(): HasMany
    {
        return $this->hasMany('App\Models\Note\NoteHistorie');
    }

}

