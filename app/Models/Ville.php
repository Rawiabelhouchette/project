<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Ville extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'pays_id',
    ];

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
    ];


    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function quartiers()
    {
        return $this->hasMany(Quartier::class);
    }
}
