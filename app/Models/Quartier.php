<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Support\Str;

class Quartier extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'ville_id',
    ];

    // mount
    public static function boot()
    {
        parent::boot();

        static::creating(function ($quartier) {
            $quartier->slug = Str::slug($quartier->nom);
        });

        static::updating(function ($quartier) {
            $quartier->slug = Str::slug($quartier->nom);
        });
    }

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'ville_id' => PurifyHtmlOnGet::class,
    ];


    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
