<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\View\View;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class LocationVehicule extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'marque',
        'modele',
        'annee',
        'carburant',
        'kilometrage',
        'boite_vitesse',
        'nombre_portes',
        'nombre_places',
    ];

    protected $casts = [
        'marque' => PurifyHtmlOnGet::class,
        'modele' => PurifyHtmlOnGet::class,
        'annee' => PurifyHtmlOnGet::class,
        'carburant' => PurifyHtmlOnGet::class,
        'kilometrage' => PurifyHtmlOnGet::class,
        'boite_vitesse' => PurifyHtmlOnGet::class,
        'nombre_portes' => PurifyHtmlOnGet::class,
        'nombre_places' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'types_vehicule',
        'equipements_vehicule',
        'conditions_location',

        'caracteristiques',
    ];

    public function getShowUrlAttribute(): string
    {
        return route('location-vehicules.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('location-vehicules.edit', $this);
    }

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getTypesVehiculeAttribute(): string
    {
        return $this->annonce->references('types-de-vehicule');
    }

    public function getEquipementsVehiculeAttribute(): string
    {
        return $this->annonce->references('equipements-vehicule');
    }

    public function getConditionsLocationAttribute(): string
    {
        return $this->annonce->references('conditions-de-location');
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
}
