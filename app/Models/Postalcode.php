<?php

namespace App\Models;

use App\Traits\HasCache;
use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Postalcode extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'postalcodes';

    protected $fillable = [
        'uid',
        'city_id',
        'code'
    ];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    public function getFullLabelAttribute()
    {
        $city = $this->city->title ?? 'Sin ciudad';
        $province = $this->city->province->title ?? 'Sin provincia';

        return "{$this->code} - {$this->title} ({$city}, {$province})";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->logFillable();
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo('App\Models\City');
    }

}
