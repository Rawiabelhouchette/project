<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Quartier extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'ville_id',
    ];

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'ville_id' => PurifyHtmlOnGet::class,
    ];

    const CREATED_BY = 'alt_created_by';
    const UPDATED_BY = 'alt_updated_by';
    const DELETED_BY = 'alt_deleted_by';

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
