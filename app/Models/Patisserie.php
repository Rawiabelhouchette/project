<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;


class Patisserie extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'nom_produit',
        'accompagnement_produit',
        'prix_produit',
        'image_produit',
    ];

    protected $casts = [
        'nom_produit' => PurifyHtmlOnGet::class,
        'accompagnement_produit' => PurifyHtmlOnGet::class,
        'prix_produit' => PurifyHtmlOnGet::class,
        'image_produit' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'equipements_restauration',

        'caracteristiques',

        'produits',
        'public_edit_url',
    ];

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute(): string
    {
        return route('pastry-shops.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('public.pastry-shops.edit', $this);
    }

    public function getEquipementsRestaurationAttribute(): array
    {
        return $this->annonce->references('equipements-restauration')->pluck('id')->toArray();
    }

    public function getShowInformationHeader(): View
    {
        return view('components.public.show.patisserie-information-header');
    }

    public function getShowInformationBody(): View
    {
        return view('components.public.show.patisserie-information-body', [
            'annonce' => $this->annonce,
        ]);
    }

    public function getStringArray($string, $separator = null)
    {
        if ($separator === null) {
            $separator = Utils::getRestaurantValueSeparator();
        }

        if (empty($string)) {
            return [];
        }
        $tmp = explode($separator, $string);
        return array_filter($tmp, function ($value) {
            return $value !== null && $value !== '';
        });
    }

    public function getCaracteristiquesAttribute(): array
    {
        $attributes = [];
        return $attributes;
    }

    public function getProduitsAttribute()
    {
        $produits = [];

        $tmp_nom = $this->getStringArray($this->nom_produit);
        $tmp_accompagnement = $this->getStringArray($this->accompagnement_produit);
        $tmp_prix = $this->getStringArray($this->prix_produit);
        $tmp_image = $this->getStringArray($this->image_produit, Utils::getRestaurantImageSeparator());

        $maxCount = max(count($tmp_nom), count($tmp_accompagnement), count($tmp_prix), count($tmp_image));

        for ($i = 0; $i < $maxCount; $i++) {
            $image = isset($tmp_image[$i]) ? Fichier::find($tmp_image[$i]) : null;
            $produits[] = [
                'id' => $i + 1,
                'nom' => $tmp_nom[$i] ?? null,
                'accompagnements' => $tmp_accompagnement[$i] ?? null,
                'prix' => isset($tmp_prix[$i]) ? (int) $tmp_prix[$i] : null,
                'image' => $image ? $image->chemin : null,
                'image_id' => $image ? $image->id : null,
            ];
        }

        return $produits;
    }

    public function getPublicEditUrlAttribute(): string
    {
        return route('public.pastry-shops.edit', $this);
    }
}
