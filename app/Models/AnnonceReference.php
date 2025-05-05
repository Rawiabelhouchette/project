<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class AnnonceReference extends Model
{
    use HasFactory, Userstamps;

    protected $table = 'annonce_reference_valeur';

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'annonce_id',
        'reference_valeur_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->titre);
        });
    }

    protected $casts = [
        'titre' => PurifyHtmlOnGet::class,
        'slug' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'reference_valeur_id' => PurifyHtmlOnGet::class,
    ];
}
