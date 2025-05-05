<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

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

    public function reference(): BelongsTo
    {
        return $this->belongsTo(Reference::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function annonceReferences(): HasMany
    {
        return $this->hasMany(AnnonceReference::class, 'reference_valeur_id');
    }
}
