<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;

class Marque extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($marque) {
            $marque->slug = Str::slug($marque->nom);
        });

        static::updating(function ($marque) {
            $marque->slug = Str::slug($marque->nom);
        });
    }

    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
