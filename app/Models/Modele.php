<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Modele extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'is_active',
        'marque_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($modele) {
            $modele->slug = Str::slug($modele->nom);
        });

        static::updating(function ($modele) {
            $modele->slug = Str::slug($modele->nom);
        });
    }

    public function marque(): BelongsTo
    {
        return $this->belongsTo(Marque::class);
    }
}
