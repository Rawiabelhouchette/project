<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Auberge extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'nombre_chambre',
        'nombre_personne',
        'superficie',
        'prix_min',
        'prix_max',
    ];

    protected $casts = [
        'nombre_chambre' => PurifyHtmlOnGet::class,
        'nombre_personne' => PurifyHtmlOnGet::class,
        'superficie' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
        'annonce_id' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'types_lit',
        'commodites',
        'services',
        'equipements_hebergement',
        'equipements_salle_bain',
        'equipements_cuisine',
        'commodites',
    ];

    
    public function getShowUrlAttribute() : String
    {
        return route('auberges.show', $this);
    }

    public function getEditUrlAttribute() : String
    {
        return route('auberges.edit', $this);
    }
    
    public function annonce() : MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getTypesLitAttribute()
    {
        return $this->annonce->references('types-de-lit');
    }

    public function getCommoditesAttribute()
    {
        return $this->annonce->references('commodites-hebergement');
    }

    public function getServicesAttribute()
    {
        return $this->annonce->references('services');
    }

    public function getEquipementsHebergementAttribute()
    {
        return $this->annonce->references('equipements-hebergement');
    }

    public function getEquipementsSalleBainAttribute()
    {
        return $this->annonce->references('equipements-salle-de-bain');
    }

    public function getEquipementsCuisineAttribute()
    {
        return $this->annonce->references('equipements-cuisine');
    }

}
