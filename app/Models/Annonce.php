<?php

namespace App\Models;

use App\Utils\AnnoncesUtils;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Stevebauman\Purify\Facades\Purify;
use Wildside\Userstamps\Userstamps;

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
        'image',
        'longitude',
        'latitude',
        'quartier',
        'ville_id',
        'prix',
    ];

    protected $appends = [
        'description_courte',
    ];

    protected $casts = [
        'titre' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'entreprise_id' => PurifyHtmlOnGet::class,
        'date_validite' => PurifyHtmlOnGet::class,
        'type' => PurifyHtmlOnGet::class,
    ];

    public function getContentAttribute($value): array|string
    {
        $config = ['HTML.Allowed' => 'div,b,a[href]'];

        return Purify::clean($value, $config);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = AnnoncesUtils::generateSlug($model->titre);
            $model->is_active = true;
            $model->date_validite = auth()->user()->activeAbonnements()->date_fin->format('Y-m-d');
        });

        static::updating(function ($model) {
            if ($model->isDirty('titre')) {
                $model->slug = AnnoncesUtils::generateSlug($model->titre);
            }
        });

        static::created(function ($model) {
            $model->addQuartier($model->quartier);
        });

        static::updated(function ($model) {
            $model->addQuartier($model->quartier);
        });
    }

    private function addQuartier($quartier)
    {
        $quartier = ucfirst(mb_strtolower($quartier));

        $existingQuartier = Quartier::where('ville_id', $this->ville_id)->where('nom', $quartier)->first();
        if ($existingQuartier) {
            $existingQuartier->update(['nom' => $quartier]);
        } else {
            Quartier::create([
                'ville_id' => $this->ville_id,
                'nom' => $quartier,
            ]);
        }
    }

    /* ######################## RELATIONS ##############################
    ###################################################################### */

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function galerie(): BelongsToMany
    {
        return $this->belongsToMany(Fichier::class, 'annonce_fichier', 'annonce_id', 'fichier_id');
    }

    public function imagePrincipale(): BelongsTo
    {
        return $this->belongsTo(Fichier::class, 'image');
    }

    public function galerieAvecImagePrincipale(): Collection
    {
        $galerie = $this->galerie;
        if ($this->imagePrincipale) {
            $galerie->prepend($this->imagePrincipale);
        }

        return $galerie;
    }

    public function annonceable(): MorphTo
    {
        return $this->morphTo();
    }

    // Retrieve specific reference value
    public function references($slug = null)
    {
        if (is_null($slug)) {
            return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->withPivot('slug', 'titre');
        }

        return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->where('slug', $slug);
    }

    public function removeReferences($slug)
    {
        $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->wherePivot('slug', $slug)->detach();
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class)->latest();
    }

    // public function notation()
    // {
    //     return $this->hasMany(Notation::class);
    // }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    // public function quartier()
    // {
    //     return $this->belongsTo(Quartier::class, 'quartier_id');
    // }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    /* ########################## METHODS ##############################
    ###################################################################### */

    // Retrieve all reference value as array
    public function referenceDisplay(): array
    {
        $references = $this->references;
        $display = [];
        foreach ($references as $reference) {
            if (! array_key_exists($reference->pivot->titre, $display)) {
                $display[$reference->pivot->titre] = [];
            }
            $display[$reference->pivot->titre][] = $reference->valeur;
        }

        return $display;
    }

    public function removeGalerie(?array $image_ids = null)
    {
        // $this->galerie()->detach();
        $this->galerie->detach($image_ids);

    }

    // permettre de mettre des nombres en format 1k, 1M
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1).'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1).'k';
        } else {
            return $number;
        }
    }

    /* ###################### ATTRIBUTES (APPENDED) ######################
    ###################################################################### */
    public function getJourRestant(): int
    {
        $date = $this->date_validite;
        $now = date('Y-m-d');
        $diff = strtotime($date) - strtotime($now);

        return round($diff / 86400) + 1;
    }

    // description courte de l'annonce en 70 caractères
    public function getDescriptionCourteAttribute(): string
    {
        if (! $this->description) {
            return 'Pas de description';
        }

        $description = $this->description;
        $description = strip_tags($description);
        $description = str_replace('&nbsp;', ' ', $description);
        $description = str_replace("\n", ' ', $description);
        $description = str_replace("\r", ' ', $description);
        $description = str_replace("\t", ' ', $description);
        $description = str_replace('  ', ' ', $description);
        $description = Str::limit($description, 70, '...');

        return $description;
    }

    // moyen de notation de l'annonce
    public function getNote()
    {
        $avg = $this->commentaires->avg('note');

        return number_format($avg, 1);
    }

    public function getEstFavoris(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return $this->favoris->where('user_id', auth()->user()->id)->count() > 0 ? true : false;
    }

    public function getViewCount(): int
    {
        return $this->views->count();
    }

    public function getFavoriteCount(): int
    {
        return $this->favoris->count();
    }

    public function getCommentCount(): int
    {
        return $this->commentaires->count();
    }

    // public function getNotationCountAttribute(): int
    // {
    //     return $this->notation()->count();
    // }

    public function getAdresseComplete(): object
    {
        $ville = $this->ville;
        $pays = $ville ? $ville->pays : null;
        $quartier = $this->quartier;

        return (object) [
            'quartier' => $quartier ? $quartier : '',
            'ville' => $ville ? $ville->nom : '',
            'pays' => $pays ? $pays->nom : '',
        ];
    }

    /* ######################## SCOPE ##############################
    ###################################################################### */
    public function scopePublic(Builder $query): void
    {
        $query
            // add some code here to make sure to only display annonce that are registrer ed to an offer
            ->whereIsActive(true)
            // check if entreprise has a valid subscription
            ->whereHas('entreprise', function ($query) {
                $query->whereHas('abonnements', function ($query) {
                    $query->where('is_active', true)
                        ->whereDate('date_fin', '>=', date('Y-m-d').' 23:59:59');
                });
            })
            // check if the annonce is still valid
            ->whereDate('date_validite', '>=', date('Y-m-d'));
    }

    public function scopeEagerLoad(Builder $query): void
    {
        $query->with(
            'annonceable',
            'commentaires',
            'entreprise.heure_ouverture',
            'imagePrincipale',
            'favoris',
            'views',
            'ville.pays',
        );
    }

    // public function scopeAll(Builder $query): void
    // {
    //     $query->
    // }
}
