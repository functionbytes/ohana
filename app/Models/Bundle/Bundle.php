<?php

namespace App\Models\Bundle;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;

class Bundle extends Model
{
    use HasFactory, InteractsWithMedia , LogsActivity;

    protected $table = 'bundles';

    protected static $recordEvents = ['deleted','updated','created'];

    protected $fillable = [
        'uid',
        'title',
        'slug',
        'description',
        'point',
        'available',
        'start_date',
        'expire_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->logFillable()->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    public function scopeDescending($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeSlug($query ,$slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function scopeUid($query ,$uid)
    {
        return $query->where('uid', $uid)->first();
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Product\Product');
    }

    public function item(): MorphMany
    {
        return $this->morphMany('App\Models\Order\OrderItem','item');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Bundle\BundleCategory');
    }

}
