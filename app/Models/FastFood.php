<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Wildside\Userstamps\Userstamps;

class FastFood extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $table = 'fast_foods';

    protected $fillable = [
        'nom_produit',
        'accompagnement_produit',
        'prix_produit',
        'image_produit',
    ];

    protected $casts = [
    ];

    protected $appends = [
        'show_url',
        // 'edit_url',

        'equipements_restauration',
        // 'produits_fast_food',

        'caracteristiques',

        'produits'
    ];

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute(): string
    {
        return route('fast-foods.show', $this);
    }

    // public function getEditUrlAttribute(): string
    // {
    //     return route('fast-foods.edit', $this);
    // }

    public function getEquipementsRestaurationAttribute(): array
    {
        return $this->annonce->references('equipements-restauration')->pluck('id')->toArray();
    }

    public function getProduitsFastFoodAttribute(): array
    {
        return $this->annonce->references('produits-fast-food')->pluck('id')->toArray();
    }

    public function getShowInformationHeader(): View
    {
        return view('components.public.show.restaurant-information-header');
    }

    public function getShowInformationBody(): View
    {
        return view('components.public.show.restaurant-information-body', [
            'annonce' => $this->annonce,
        ]);
    }

    public function getCaracteristiquesAttribute(): array
    {
        $attributes = [];

        if ($this->prix_min) {
            $attributes['Prix minimum'] = $this->prix_min;
        }

        if ($this->prix_max) {
            $attributes['Prix maximum'] = $this->prix_max;
        }

        foreach ($attributes as $key => $value) {
            if (is_numeric($value)) {
                $attributes[$key] = number_format($value, 0, ',', ' ');
            }
        }

        return $attributes;
    }

    public function getProduitsAttribute()
    {
        $plats = [];

        $tmp_nom = $this->getStringArray($this->nom_produit);
        $tmp_accompagnement = $this->getStringArray($this->accompagnement_produit);
        $tmp_prix = $this->getStringArray($this->prix_produit);
        $tmp_image = $this->getStringArray($this->image_produit, Utils::getRestaurantImageSeparator());

        $maxCount = max(count($tmp_nom), count($tmp_accompagnement), count($tmp_prix), count($tmp_image));

        for ($i = 0; $i < $maxCount; $i++) {
            $image = isset($tmp_image[$i]) ? Fichier::find($tmp_image[$i]) : null;
            $plats[] = [
                'nom' => $tmp_nom[$i] ?? null,
                'accompagnements' => $tmp_accompagnement[$i] ?? null,
                'prix' => isset($tmp_prix[$i]) ? (int) $tmp_prix[$i] : null,
                'image' => $image ? $image->chemin : null,
            ];
        }

        return $plats;
    }
}
