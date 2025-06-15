<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelter extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'zone_id',
        'open_hour',
        'close_hour',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
