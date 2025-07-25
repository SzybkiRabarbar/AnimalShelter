<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    protected $fillable = [
        'uuid',
        'name',
    ];

    public function shelters(): HasMany
    {
        return $this->hasMany(Shelter::class);
    }
}
