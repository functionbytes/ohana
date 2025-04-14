<?php

namespace App\Models\Statement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatementAnnotationType extends Model
{
    use HasFactory;

    protected $table = "statement_annotations_types";

    protected $fillable = [
        'uid',
        'title',
        'slug',
        'available',
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
    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function annotations() : HasMany
    {
        return $this->hasMany('App\Models\Statement\NoteAnnotation', 'type_id');
    }

}
