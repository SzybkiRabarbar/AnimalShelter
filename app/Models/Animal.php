<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    protected $fillable = [
        'uuid',
        'type',
        'name',
        'is_male',
        'breed',
        'date_of_birth',
        'description',
        'history',
        'likes',
        'dislikes',
        'arrival_date',
        'is_archived',
        'archived_date',
        'archive_cause',
        'shelter_id',
    ];

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(UserAnimalView::class);
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }
}
