<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\LocationMeublee;

class LocationMeubleeController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.location-meublee');
    }

    public function edit(LocationMeublee $furnishedRental)
    {
        return view('public.user.annonce.edit.location-meublee', [
            'locationMeublee' => $furnishedRental,
        ]);
    }
}
