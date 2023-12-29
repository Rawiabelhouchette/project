<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Bar extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'type_bar',
        'type_musique',
        'capacite_accueil',
        'prix_min',
        'prix_max',
    ];

    protected $casts = [
        'type_bar' => PurifyHtmlOnGet::class,
        'type_musique' => PurifyHtmlOnGet::class,
        'capacite_accueil' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'equipements_vie_nocturne',
        'commodites_vie_nocturne',

        'caracteristiques',
    ];

    public function annonce()
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute() : String
    {
        return route('bars.show', $this);
    }

    public function getEditUrlAttribute() : String
    {
        return route('bars.edit', $this);
    }

    public function getEquipementsVieNocturneAttribute()
    {
        return $this->annonce->references('equipements-vie-nocturne');
    }

    public function getCommoditesVieNocturneAttribute()
    {
        return $this->annonce->references('commodites-vie-nocturne');
    }

    public function getCaracteristiquesAttribute()
    {
        $attributes = []; 

        if ($this->type_bar) {
            $attributes['Type de bar'] = $this->type_bar;
        }

        if ($this->type_musique) {
            $attributes['Type de musique'] = $this->type_musique;
        }

        if ($this->capacite_accueil) {
            $attributes['Capacité d\'accueil'] = $this->capacite_accueil;
        }

        if ($this->prix_min) {
            $attributes['Prix minimum'] = $this->prix_min;
        }

        if ($this->prix_max) {
            $attributes['Prix maximum'] = $this->prix_max;
        }

        return $attributes;
    }
}
