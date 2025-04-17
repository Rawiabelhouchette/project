<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Bar extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'type_bar',
        'capacite_accueil',
        'prix_min',
        'prix_max',
    ];

    protected $casts = [
        'type_bar' => PurifyHtmlOnGet::class,
        'capacite_accueil' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        // 'edit_url',

        'equipements_vie_nocturne',
        'commodites_vie_nocturne',

        'caracteristiques',

        'public_edit_url',
    ];

    public function annonce()
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute(): string
    {
        return route('bars.show', $this);
    }

    // public function getEditUrlAttribute(): string
    // {
    //     return route('bars.edit', $this);
    // }

    public function getEquipementsVieNocturneAttribute()
    {
        return $this->annonce->references('equipements-vie-nocturne');
    }

    public function getCommoditesVieNocturneAttribute()
    {
        return $this->annonce->references('commodites-vie-nocturne');
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
            'Type de bar' => $this->type_bar,
            'Type de musique' => $this->type_musique,
            'Capacité d\'accueil' => $this->capacite_accueil,
            'Prix minimum' => $this->prix_min ? number_format($this->prix_min, 0, ',', ' ') : null,
            'Prix maximum' => $this->prix_max ? number_format($this->prix_max, 0, ',', ' ') : null,
        ];

        return array_filter($attributes, function ($value) {
            return !is_null($value);
        });
    }

    public function getPublicEditUrlAttribute(): string
    {
        return route('public.bars.edit', $this);
    }
}
