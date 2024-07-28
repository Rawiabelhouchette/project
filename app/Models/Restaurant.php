<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Support\Str;


class Restaurant extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'e_nom',
        'e_slug',
        'e_ingredients',
        'e_prix_min',
        'e_prix_max',

        'p_nom',
        'p_slug',
        'p_ingredients',
        'p_prix_min',
        'p_prix_max',

        'd_nom',
        'd_slug',
        'd_ingredients',
        'd_accompagnements',
        'd_prix_min',
        'd_prix_max',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->e_slug = Str::slug($model->e_nom);
            $model->p_slug = Str::slug($model->p_nom);
            $model->d_slug = Str::slug($model->d_nom);
        });

        static::updating(function ($model) {
            $model->e_slug = Str::slug($model->e_nom);
            $model->p_slug = Str::slug($model->p_nom);
            $model->d_slug = Str::slug($model->d_nom);
        });
    }


    protected $casts = [
        'e_nom' => PurifyHtmlOnGet::class,
        'e_ingredients' => PurifyHtmlOnGet::class,
        'e_prix_min' => PurifyHtmlOnGet::class,
        'e_prix_max' => PurifyHtmlOnGet::class,

        'p_nom' => PurifyHtmlOnGet::class,
        'p_ingredients' => PurifyHtmlOnGet::class,
        'p_prix_min' => PurifyHtmlOnGet::class,
        'p_prix_max' => PurifyHtmlOnGet::class,

        'd_nom' => PurifyHtmlOnGet::class,
        'd_ingredients' => PurifyHtmlOnGet::class,
        'd_prix_min' => PurifyHtmlOnGet::class,
        'd_prix_max' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'specialites',
        'equipements_restauration',
        'carte_consommation',

        'caracteristiques',

        'entrees',
        'plats',
        'desserts',
    ];

    public function getShowUrlAttribute(): string
    {
        return route('restaurants.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('restaurants.edit', $this);
    }

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getSpecialitesAttribute()
    {
        return $this->annonce->references('specialites');
    }

    public function getEquipementsRestaurationAttribute()
    {
        return $this->annonce->references('equipements-restauration');
    }

    public function getCarteConsommationAttribute()
    {
        return $this->annonce->references('carte-de-consommation');
    }

    public function getCaracteristiquesAttribute(): View
    {
        $attributes = [];

        if ($this->e_nom) {
            $attributes['Nom'] = $this->e_nom;
        }

        if ($this->e_ingredients) {
            $attributes['Ingrédients'] = $this->e_ingredients;
        }

        if ($this->e_prix_min) {
            $attributes['Prix minimum'] = $this->e_prix_min;
        }

        if ($this->e_prix_max) {
            $attributes['Prix maximum'] = $this->e_prix_max;
        }

        if ($this->p_nom) {
            $attributes['Nom '] = $this->p_nom;
        }

        if ($this->p_ingredients) {
            $attributes['Ingrédients '] = $this->p_ingredients;
        }

        if ($this->p_prix_min) {
            $attributes['Prix minimum '] = $this->p_prix_min;
        }

        if ($this->p_prix_max) {
            $attributes['Prix maximum '] = $this->p_prix_max;
        }

        if ($this->d_nom) {
            $attributes['Nom  '] = $this->d_nom;
        }

        if ($this->d_ingredients) {
            $attributes['Ingrédients  '] = $this->d_ingredients;
        }

        if ($this->d_prix_min) {
            $attributes['Prix minimum  '] = $this->d_prix_min;
        }

        if ($this->d_prix_max) {
            $attributes['Prix maximum  '] = $this->d_prix_max;
        }

        foreach ($attributes as $key => $value) {
            if (is_numeric($value)) {
                $attributes[$key] = number_format($value, 0, ',', ' ');
            }
        }

        return view('components.public.show.restaurant', [
            'caracteristiques' => $attributes,
        ]);
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

    // function to transform string into array using explode '&nbsp;' as separator
    public function getStringArray($string)
    {
        $tmp = explode('&nbsp;', $string);
        $tmp = array_filter($tmp);
        return $tmp;
    }

    public function getEntreesAttribute() //: object
    {
        $entrees = [];
        // $entrees['Nom'] = $this->getStringArray($this->e_nom);
        // $entrees['Ingrédients'] = $this->getStringArray($this->e_ingredients);
        // $entrees['Prix minimum'] = $this->getStringArray($this->e_prix_min);
        // $entrees['Prix maximum'] = $this->getStringArray($this->e_prix_max);
        // $entrees [] = [
        //     'Nom',
        //     'Ingrédients',
        //     'Prix minimum',
        //     'Prix maximum'
        // ];

        $tmp_nom = $this->getStringArray($this->e_nom);
        $tmp_ingredients = $this->getStringArray($this->e_ingredients);
        $tmp_prix_min = $this->getStringArray($this->e_prix_min);
        $tmp_prix_max = $this->getStringArray($this->e_prix_max);

        for ($i = 0; $i < count($tmp_nom); $i++) {
            $entrees [] = [
                $tmp_nom[$i],
                $tmp_ingredients[$i],
                $tmp_prix_min[$i],
                $tmp_prix_max[$i]
            ];
        }
        
        return $entrees;
        // return (object) $entrees;
    }

}
