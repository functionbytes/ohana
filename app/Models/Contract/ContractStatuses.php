<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUid;

class ContractStatuses extends Model
{
    use HasFactory , HasUid;

    protected $table = "contract_statuses";

    protected $fillable = [
        'uid',
        'title',
        'slug',
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

    public function scopeSlug($query ,$slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function contracts() : HasMany
    {
        return $this->hasMany('App\Models\Contract\Commission', 'status_id');
    }

}
