<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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

    public function getShowUrlAttribute() : String
    {
        return route('location-vehicules.show', $this);
    }

    public function getEditUrlAttribute() : String
    {
        return route('location-vehicules.edit', $this);
    }

    public function annonce() : MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getTypesVehiculeAttribute() : String
    {
        return $this->annonce->references('types-de-vehicule');
    }

    public function getEquipementsVehiculeAttribute() : String
    {
        return $this->annonce->references('equipements-vehicule');
    }

    public function getConditionsLocationAttribute() : String
    {
        return $this->annonce->references('conditions-de-location');
    }

    public function getCaracteristiquesAttribute() : Array
    {
        return [
            'Marque' => $this->marque,
            'Modèle' => $this->modele,
            'Année' => $this->annee,
            'Carburant' => $this->carburant,
            'Kilométrage' => $this->kilometrage,
            'Boite de vitesse' => $this->boite_vitesse,
            'Nombre de portes' => $this->nombre_portes,
            'Nombre de places' => $this->nombre_places,
        ];
    }
    
}
