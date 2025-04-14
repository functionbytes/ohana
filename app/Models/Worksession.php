<?php

namespace App\Models;

use App\Traits\HasUid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksession extends Model
{
    use HasFactory ,HasUid;

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
    public function scopeTodayForEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId)->whereDate('work_date', now()->toDateString());
    }

    public function getCheckInFormattedAttribute(): string
    {
        if ($this->work_date && $this->check_in) {
            return Carbon::createFromFormat('Y-m-d H:i:s', "{$this->work_date} {$this->check_in}")->format('H:i d/m/Y');
        }

        return '—';
    }

    public function getCheckOutFormattedAttribute(): string
    {
        if ($this->work_date && $this->check_out) {
            return Carbon::createFromFormat('Y-m-d H:i:s', "{$this->work_date} {$this->check_out}")->format('H:i d/m/Y');
        }

        return '—';
    }


    public function employee()
    {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }


}
