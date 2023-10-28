<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Reference extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'type',
        'nom',
    ];

    protected $casts = [
        'type' => PurifyHtmlOnGet::class,
        'nom' => PurifyHtmlOnGet::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
