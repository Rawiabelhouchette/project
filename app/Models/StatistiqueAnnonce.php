<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistiqueAnnonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'annonce_id',
        'nb_vue',
        'nb_vue_par_jour',
        'nb_vue_par_semaine',
        'nb_vue_par_mois',
        'nb_partage',
        'nb_favoris',
        'nb_commentaire',
        'nb_notation',
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
