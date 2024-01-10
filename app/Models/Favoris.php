<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    use HasFactory;

    protected $fillable = [
        'usager_id',
        'annonce_id',
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
