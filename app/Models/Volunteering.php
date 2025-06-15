<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Volunteering extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'animal_id',
        'volunteer_date',
        'is_accepted',
        'took_place',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }
}
