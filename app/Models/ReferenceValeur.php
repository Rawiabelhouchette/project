<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class ReferenceValeur extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'reference_id',
        'valeur',
    ];

    protected $casts = [
        'valeur' => PurifyHtmlOnGet::class,
    ];

    const CREATED_BY = 'alt_created_by';
    const UPDATED_BY = 'alt_updated_by';
    const DELETED_BY = 'alt_deleted_by';

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
}
