<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;


class Annonce extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'titre',
        'description',
        'slug',
        'entreprise_id',
        'is_active',
        'date_validite',
        'annonceable_type',
        'annonceable_id',
        'type',
    ];

    protected $appends = [
        'jour_restant',
    ];

    protected $casts = [
        'titre' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'entreprise_id' => PurifyHtmlOnGet::class,
        'date_validite' => PurifyHtmlOnGet::class,
        'type' => PurifyHtmlOnGet::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->titre);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->titre);
        });
    }

    public function entreprise() : BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function galerie() : BelongsToMany
    {
        return $this->belongsToMany(Fichier::class, 'annonce_fichier', 'annonce_id', 'fichier_id');
    }

    public function annonceable()
    {
        return $this->morphTo();
    }

    // Retrieve specific reference value
    public function references($slug = null)
    {
        if (is_null($slug)) {
            // For save reference through pivot table
            return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->withPivot('slug', 'titre');
        }
        return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->where('slug', $slug)->get();
    }

    // Retrieve all reference value as array
    public function referenceDisplay() : Array
    {
        $references = $this->references()->get();
        $display = [];
        foreach ($references as $reference) {
            if (!array_key_exists($reference->pivot->titre, $display)) {
                $display[$reference->pivot->titre] = [];
            }
            $display[$reference->pivot->titre][] = $reference->valeur;
            
        }
        return $display;
    }

    public function getJourRestantAttribute() : int
    {
        $date = $this->date_validite;
        $now = date('Y-m-d');
        $diff = strtotime($date) - strtotime($now);
        return round($diff / 86400) + 1;
    }

    public function removeGalerie()
    {
        $this->galerie()->detach();
    }

    public function removeReferences($slug)
    {
        $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->wherePivot('slug', $slug)->detach();
    }

}
