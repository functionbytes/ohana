<?php

namespace App\Models;

use App\Traits\HasCache;
use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    use HasFactory, LogsActivity, HasCache, HasUid;

    protected $table = 'cities';

    protected $fillable = [
        'uid',
        'province_id',
        'name'
    ];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->logFillable();
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function postalCodes(): HasMany
    {
        return $this->hasMany('App\Models\PostalCode');
    }
}
