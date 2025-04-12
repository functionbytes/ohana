<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class NoteHistorie extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "notes_histories";

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected $fillable = [
        'uid',
        'employee_id',
        'customer_id',
        'status_id',
        'call_at',
        'next_call_at',
        'notes',
        'created_at',
        'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->logFillable() ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo('App\Models\Note\NoteStatuses', 'status_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }

}
