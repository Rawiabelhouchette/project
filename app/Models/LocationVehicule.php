<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class LocationVehicule extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'annee',
        'carburant',
        'kilometrage',
        'boite_vitesse',
        'nombre_portes',
        'nombre_places',
        'modele_id',
    ];

    protected $casts = [
        'annee' => PurifyHtmlOnGet::class,
        'carburant' => PurifyHtmlOnGet::class,
        'kilometrage' => PurifyHtmlOnGet::class,
        'boite_vitesse' => PurifyHtmlOnGet::class,
        'nombre_portes' => PurifyHtmlOnGet::class,
        'nombre_places' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        // 'edit_url',

        'types_vehicule',
        'equipements_vehicule',
        'conditions_location',

        'caracteristiques',

        'public_edit_url',
    ];

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }

    public function getShowUrlAttribute(): string
    {
        return route('location-vehicules.show', $this);
    }

    // public function getEditUrlAttribute(): string
    // {
    //     return route('location-vehicules.edit', $this);
    // }
    public function getTypesVehiculeAttribute(): string
    {
        return $this->annonce->references('types-de-voiture')->get();
    }

    public function getEquipementsVehiculeAttribute(): string
    {
        return $this->annonce->references('options-accessoires')->get();
    }

    public function getConditionsLocationAttribute(): string
    {
        return $this->annonce->references('conditions-de-location')->get();
    }

    public function getShowInformationHeader(): View
    {
        return view('components.public.show.default-information-header');
    }

    public function getShowInformationBody(): View
    {
        return view('components.public.show.default-information-body', [
            'annonce' => $this->annonce,
        ]);
    }

    public function getCaracteristiquesAttribute(): array
    {
        $attributes = [
            'Marque' => $this->modele_id ? $this->modele->marque->nom : null,
            'Modèle' => $this->modele_id ? $this->modele->nom : null,
            'Année' => $this->annee,
            'Carburant' => $this->carburant,
            'Kilométrage' => $this->kilometrage,
            'Boite de vitesse' => $this->boite_vitesse,
            'Nombre de portes' => $this->nombre_portes,
            'Nombre de places' => $this->nombre_places,
        ];

        $attributes = array_filter($attributes, function ($value) {
            return ! is_null($value);
        });

        foreach ($attributes as $key => $value) {
            if (is_numeric($value)) {
                $attributes[$key] = number_format($value, 0, ',', ' ');
            }
        }

        return $attributes;
    }

    public function getPublicEditUrlAttribute(): string
    {
        return route('public.vehicle-rentals.edit', $this);
    }
}
