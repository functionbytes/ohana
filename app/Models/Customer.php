<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use LogsActivity , HasUid;

    protected $table = "customers";

    protected $fillable = [
        'uid',
        'firstname',
        'lastname',
        'email',
        'identification',
        'cellphone',
        'phone',
        'address',
        'secondaddress',
        'postcode',
        'comments',
        'parish',
        'iban',
        'parish',
        'postalcode_id',
        'birth_at',
        'created_at',
        'updated_at'
    ];

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeUid($query, $uid)
    {
        return $query->where('uid', $uid)->first();
    }

    public function postalcode(): BelongsTo
    {
        return $this->belongsTo('App\Models\Postalcode', 'postalcode_id', 'id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany('App\Models\Note\Note', 'customer_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany('App\Models\Contract\Commission', 'customer_id');
    }


    public function getFullNameAttribute()
    {
        $full = trim("{$this->firstname} {$this->lastname}");
        return empty($full) ? 'N/N' : Str::words(Str::upper(Str::lower($full)), 12, '...');
    }

    public function getFullName($default = null)
    {
        $full = trim($this->firstname.' '.$this->lastname);

        if (empty($full)) {
            return $default;
        } else {
            return $full;
        }
    }

    public function getFullNameOrEmail()
    {
        $full = $this->getFullName();
        if (empty($full)) {
            return $this->email;
        } else {
            return $full;
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->logFillable();
    }

}


