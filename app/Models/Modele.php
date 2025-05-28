<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;

class Modele extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'is_active',
        'marque_id',
        'created_by',
        'updated_by',
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function locationVehicules()
    {
        return $this->hasMany(LocationVehicule::class, 'modele_id');
    }
}
