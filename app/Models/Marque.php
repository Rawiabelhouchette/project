<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Marque extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($marque) {
            $marque->slug = Str::slug($marque->nom);
        });

        static::updating(function ($marque) {
            $marque->slug = Str::slug($marque->nom);
        });
    }

    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }
}
