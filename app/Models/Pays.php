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

    const CREATED_BY = 'alt_created_by';
    const UPDATED_BY = 'alt_updated_by';
    const DELETED_BY = 'alt_deleted_by';

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}
