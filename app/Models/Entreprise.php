<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Entreprise extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'description',
        'site_web',
        'email',
        'telephone',
        'instagram',
        'facebook',
        'whatsapp',
        'logo',
        'quartier_id',
        'longitude',
        'latitude',
    ];

    protected $appends = [
        'nombre_annonces',
    ];

    public function getNombreAnnoncesAttribute()
    {
        return $this->annonce()->count();
    }


    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'site_web' => PurifyHtmlOnGet::class,
        'email' => PurifyHtmlOnGet::class,
        'telephone' => PurifyHtmlOnGet::class,
        'instagram' => PurifyHtmlOnGet::class,
        'facebook' => PurifyHtmlOnGet::class,
        'whatsapp' => PurifyHtmlOnGet::class,
        'logo' => PurifyHtmlOnGet::class,
        'quartier_id' => PurifyHtmlOnGet::class,
        'longitude' => PurifyHtmlOnGet::class,
        'latitude' => PurifyHtmlOnGet::class,
    ];


    public function heure_ouvertures()
    {
        return $this->hasMany(HeureOuverture::class, 'entreprise_id');
    }

    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier_id');
    }



    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function annonce()
    {
        return $this->hasMany(Annonce::class, 'entreprise_id');
    }

}
