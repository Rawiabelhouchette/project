<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'user_id',
        'parent_id',
        'annonce_id',
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function parent()
    {
        return $this->belongsTo(Commentaire::class, 'parent_id');
    }

    public function reponses()
    {
        return $this->hasMany(Commentaire::class, 'parent_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i:s', strtotime($value));
    }
}
