<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demande extends Model
{
    use HasFactory;

    public function comite(): BelongsTo
    {
        return $this->belongsTo(Comite::class);
    }

    public function precedent(): BelongsTo
    {
        return $this->BelongsTo(Demande::class);
    }

    public function subsequent(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
}
