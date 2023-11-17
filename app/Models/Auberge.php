<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Auberge extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'nombre_chambre',
        'nombre_personne',
        'superficie',
        'prix_min',
        'prix_max',
        'annonce_id',
    ];

    protected $casts = [
        'nombre_chambre' => PurifyHtmlOnGet::class,
        'nombre_personne' => PurifyHtmlOnGet::class,
        'superficie' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
        'annonce_id' => PurifyHtmlOnGet::class,
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
