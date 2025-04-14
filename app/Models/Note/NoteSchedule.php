<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class NoteSchedule extends Model
{
    use HasFactory;

    protected $table = "notes_schedules";

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

    public function notes() : HasMany
    {
        return $this->hasMany('App\Models\Note\NoteHistorie', 'status_id');
    }

}
