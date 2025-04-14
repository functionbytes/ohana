<?php

namespace App\Models\Statement;

use App\Traits\HasUid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatementAnnotation extends Model
{
    use HasFactory,HasUid;

    protected $table = "statement_annotations";
    protected $fillable = [
        'uid',
        'issue',
        'observations',
        'note_id',
        'statement_id',
        'commercial_id',
        'type_id',
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtFormattedAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('d M Y H:i');
    }


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

    public function note(): BelongsTo
    {
        return $this->belongsTo('App\Models\Note\Note', 'note_id');
    }

    public function commercial(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'commercial_id');
    }
    public function statement(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\Statement', 'statement_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statement\StatementAnnotationType', 'type_id');
    }


}
