<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    protected $fillable = [
        'question_id',
        'label',
        'votes_count'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

}
