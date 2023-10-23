<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;


class Pays extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $table = 'pays';

    protected $fillable = [
        'nom',
        'slug',
        'code',
        'indicatif',
        'langue',
    ];

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'code' => PurifyHtmlOnGet::class,
        'indicatif' => PurifyHtmlOnGet::class,
        'langue' => PurifyHtmlOnGet::class,
    ];

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}
