<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Favoris extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'annonce_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($favoris) {
            try {
                $stat = StatistiqueAnnonce::where('annonce_id', $favoris->annonce_id)->first();
                if ($stat) {
                    $stat->increment('nb_favoris');
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        });

        static::deleting(function ($favoris) {
            try {
                $stat = StatistiqueAnnonce::where('annonce_id', $favoris->annonce_id)->first();
                if ($stat) {
                    $stat->decrement('nb_favoris');
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        });
    }

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
