<?php

namespace App\Models\Delegation;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Delegation extends Model
{
    use HasFactory , LogsActivity ,HasUid;

    protected static $recordEvents = ['deleted','updated','created'];

    protected $table = 'delegations';

    protected $fillable = [
        'uid',
        'title',
        'address',
        'cellphone',
        'nit',
        'leading',
        'supporting',
        'leading',
        'available',
        'created_at',
        'updated_at'
    ];

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeUid($query ,$uid)
    {
        return $query->where('uid', $uid)->first();
    }
    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }
    public function scopeDescending($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeDistributorOrdersByDate($query, $distributor, $start, $end)
    {
        return $query->whereHas('orders', function ($q) use ($start, $end, $distributor) {
            $q->whereBetween('created_at', [$start, $end])->where('invoiced', 0)->where('id_type', $distributor);
        });
    }


    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");

    }


    public function locations(): HasMany
    {
        return $this->hasMany('App\Models\Location\Location', 'delegation_id', 'id');
    }

    public function staffs(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'distributor_staff')->withPivot('distributor_id')->orderBy('created_at', 'desc');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Course\Course', 'distributor_courses')->withPivot('distributor_id');
    }

    public function rates(): HasMany
    {
        return $this->hasMany('App\Models\Distributor\DistributorCourse','distributor_id')->orderBy('created_at', 'desc');
    }

    public function orders(): HasMany
    {
        return $this->hasMany('App\Models\Order\OrderActivity')->orderBy('created_at', 'desc');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany('App\Models\Invoice\Note','distributor_id')->orderBy('created_at', 'desc');
    }

    public function ordersDistributor(): HasMany
    {
        return $this->hasMany('App\Models\Order\Order', 'distributor_id')->orderBy('created_at', 'desc');
    }

    public function ordersActitity(): HasMany
    {
        return $this->hasMany('App\Models\Order\OrderActivity', 'distributor_id')->orderBy('created_at', 'desc');
    }

    public function ordersActititys()
    {
        return $this->hasManyThrough(
            'App\Models\Order\Order',  // Modelo final al que queremos acceder (Order)
            'App\Models\Order\OrderActivity',  // Modelo intermedio (OrderActivity)
            'distributor_id',  // Clave foránea en la tabla intermedia (OrderActivity)
            'id',  // Clave primaria en la tabla destino (Order)
            'id',  // Clave primaria en la tabla origen (Distributor)
            'order_id'  // Clave foránea en la tabla intermedia (OrderActivity)
        );
    }



}


