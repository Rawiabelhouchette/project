<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Quartier extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'ville_id',
    ];

    protected $appends = [
        'nombre_annonce',
    ];

    // mount
    public static function boot()
    {
        parent::boot();

        static::creating(function ($quartier) {
            $quartier->slug = Str::slug($quartier->nom);
        });

        static::updating(function ($quartier) {
            $quartier->slug = Str::slug($quartier->nom);
        });
    }

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'ville_id' => 'integer',
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    // All quartiers with their ville and their pays ex : "Avedji, Lome, Togo"
    // return array of string
    public static function getAllQuartiers(): array
    {
        return Quartier::with('ville.pays')->get()
            ->map(fn ($quartier) => "{$quartier->nom}, {$quartier->ville->nom}, {$quartier->ville->pays->nom}")
            ->toArray();
    }

    public function getNombreAnnonceAttribute()
    {
        // $ville = $this->nom;
        // $count = Annonce::public()->whereHas('entreprise.ville', function ($query) use ($ville) {
        //     $query->where('nom', $ville);
        // })->count();

        // return $count;

        return $this->annonces->count();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'quartier', 'nom');
    }
}
