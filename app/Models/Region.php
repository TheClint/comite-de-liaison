<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    public function departements(): HasMany
    {
        return $this->hasMany(Departement::class);
    }

    public function comites(): HasMany
    {
        return $this->hasMany(Comite::class);
    }
}
