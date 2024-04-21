<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAbonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'duree', // en mois
        'is_active',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    // add a scroped query
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }


    protected $appends = [
        'offres',
    ];

    public function getOffresAttribute(): array
    {
        $offres = [];
        return $offres;
    }
}
