<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\In;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;


class Annonce extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'titre',
        'description',
        'slug',
        'entreprise_id',
        'is_active',
        'date_validite',
        'annonceable_type',
        'annonceable_id',
        'type',
    ];

    protected $appends = [
        'jour_restant',
        'description_courte',
        // 'note',
        'est_favoris',

        // stat
        'nb_vue',
        'nb_vue_par_jour',
        'nb_vue_par_semaine',
        'nb_vue_par_mois',
        'nb_partage',
        'nb_favoris',
        'nb_commentaire',
        'nb_notation',
    ];

    protected $casts = [
        'titre' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'entreprise_id' => PurifyHtmlOnGet::class,
        'date_validite' => PurifyHtmlOnGet::class,
        'type' => PurifyHtmlOnGet::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->titre);

            if (!$model->statistique) {
                $model->statistique()->create([
                    'nb_vue' => 0,
                    'nb_vue_par_jour' => 0,
                    'nb_vue_par_semaine' => 0,
                    'nb_vue_par_mois' => 0,
                    'nb_partage' => 0,
                    'nb_favoris' => 0,
                    'nb_commentaire' => 0,
                ]);
            }
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->titre);
        });
    }

    public function entreprise() : BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function galerie() : BelongsToMany
    {
        return $this->belongsToMany(Fichier::class, 'annonce_fichier', 'annonce_id', 'fichier_id');
    }

    public function annonceable()
    {
        return $this->morphTo();
    }

    // Retrieve specific reference value
    public function references($slug = null)
    {
        if (is_null($slug)) {
            return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->withPivot('slug', 'titre');
        }
        return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->where('slug', $slug)->get();
    }

    // Retrieve all reference value as array
    public function referenceDisplay() : Array
    {
        $references = $this->references()->get();
        $display = [];
        foreach ($references as $reference) {
            if (!array_key_exists($reference->pivot->titre, $display)) {
                $display[$reference->pivot->titre] = [];
            }
            $display[$reference->pivot->titre][] = $reference->valeur;
            
        }
        return $display;
    }


    public function getJourRestantAttribute() : int
    {
        $date = $this->date_validite;
        $now = date('Y-m-d');
        $diff = strtotime($date) - strtotime($now);
        return round($diff / 86400) + 1;
    }

    public function removeGalerie()
    {
        $this->galerie()->detach();
    }

    public function removeReferences($slug)
    {
        $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->wherePivot('slug', $slug)->detach();
    }

    // permettre de mettre des nombres en format 1k, 1M
    private function formatNumber($number) {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k';
        } else {
            return $number;
        }
    }

    // description courte de l'annonce en 70 caractères
    public function getDescriptionCourteAttribute(): string
    {
        $description = $this->description;
        $description = strip_tags($description);
        $description = str_replace('&nbsp;', ' ', $description);
        $description = str_replace("\n", ' ', $description);
        $description = str_replace("\r", ' ', $description);
        $description = str_replace("\t", ' ', $description);
        $description = str_replace('  ', ' ', $description);
        $description = substr($description, 0, 70);

        if (Str::length($description) >= 70) {
            $description = $description . '...';
        }

        return $description;
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function statistique()
    {
        return $this->hasOne(StatistiqueAnnonce::class);
    }

    public function notation()
    {
        return $this->hasMany(Notation::class);
    }

    // moyen de notation de l'annonce
    public function getNoteAttribute() : float
    {
        $avg = $this->notation()->avg('note');

        // si la moyenne est null, on retourne 0
        if (is_null($avg)) {
            return 0;
        }

        // arrondir à l'entier supérieur si la décimale est supérieur ou égale à 0.5
        $decimal = $avg - floor($avg);
        // dd($decimal);
        if ($decimal >= 0 && $decimal < 0.5) {
            return floor($avg);
        } else {
            return ceil($avg);
        }

        
    }

    public function getEstFavorisAttribute() : bool
    {
        return $this->favoris()->where('user_id', auth()->user()->id)->exists();
    }

    public function getNbVueAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_vue);
    }

    public function getNbVueParJourAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_vue_par_jour);
    }

    public function getNbVueParSemaineAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_vue_par_semaine);
    }

    public function getNbVueParMoisAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_vue_par_mois);
    }

    public function getNbPartageAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_partage);
    }

    public function getNbFavorisAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_favoris);
    }

    public function getNbCommentaireAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_commentaire);
    }

    public function getNbNotationAttribute() : string
    {
        return $this->formatNumber($this->statistique->nb_notation);
    }
}
