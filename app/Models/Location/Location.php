<?php

namespace App\Models\Location;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Location extends Model
{
    use HasFactory , LogsActivity ,HasUid;

    protected static $recordEvents = ['deleted','updated','created'];

    protected $table = 'delegation_locations';

    protected $fillable = [
        'uid',
        'title',
        'address',
        'available',
        'delegation_id',
        'created_at',
        'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->logFillable()->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    public function scopeDescending($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('updated_at', 'asc');
    }

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeUid($query ,$uid){
        return $query->where('uid', $uid)->first();
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'locations_employees')->withPivot('location_id')->orderBy('updated_at', 'desc');
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'enterprise_user')->withPivot('location_id')->orderBy('updated_at', 'desc');
    }

    public function delegation()
    {
        return $this->belongsTo('App\Models\Delegation\Delegation', 'delegation_id', 'id');
    }


}
