<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksession extends Model
{
    use HasFactory;

    protected $table = 'worksessions';

    protected $fillable = [
        'uid',
        'employee_id',
        'work_date',
        'check_in',
        'check_out',
        'notes',
    ];

    protected $dates = [
        'work_date',
        'check_in',
        'check_out',
    ];

    public function scopeDescending($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAscending($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeUid($query, $uid)
    {
        return $query->where('uid', $uid)->first();
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }


}
