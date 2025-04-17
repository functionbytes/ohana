<?php

namespace App\Models\Statement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUid;

class StatementEmployment extends Model
{
    use HasFactory , HasUid;

    protected $table = "statement_employments";

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

    public function scopeDescending($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeUid($query, $uid)
    {
        return $query->where('uid', $uid)->first();
    }

    public function scopeSlug($query ,$slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function statements() : HasMany
    {
        return $this->hasMany('App\Models\Statement\Statement', 'payment_id');
    }

}
