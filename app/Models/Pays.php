<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

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

    // mount
    public static function boot()
    {
        parent::boot();

        static::creating(function ($pays) {
            $pays->slug = Str::slug($pays->nom);
        });

        static::updating(function ($pays) {
            $pays->slug = Str::slug($pays->nom);
        });
    }

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'code' => PurifyHtmlOnGet::class,
        'indicatif' => PurifyHtmlOnGet::class,
        'langue' => PurifyHtmlOnGet::class,
    ];

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
