<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;


class Patisserie extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'ingredients',
        'accompagnement',
        'prix_min',
        'prix_max',
    ];

    protected $casts = [
        'ingredients' => PurifyHtmlOnGet::class,
        'accompagnement' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'produits_patissiers',
        'equipements_patisserie',

        'caracteristiques',
    ];

    public function annonce()
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute() : String
    {
        return route('patisseries.show', $this);
    }

    public function getEditUrlAttribute() : String
    {
        return route('patisseries.edit', $this);
    }

    public function getProduitsPatissiersAttribute()
    {
        return $this->annonce->references('produits-patissiers');
    }

    public function getEquipementsPatisserieAttribute()
    {
        return $this->annonce->references('equipements-patisserie');
    }

    public function getCaracteristiquesAttribute(): array
    {
        $attributes = [];

        if ($this->ingredients) {
            $attributes['Ingrédients'] = $this->ingredients;
        }

        if ($this->accompagnement) {
            $attributes['Accompagnement'] = $this->accompagnement;
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
