<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\LocationVehicule;
use Illuminate\Http\Request;

class LocationVehiculeController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.location-vehicule');
    }

    public function edit(LocationVehicule $vehicleRental)
    {
        return view('public.user.annonce.edit.location-vehicule', [
            'locationVehicule' => $vehicleRental,
        ]);
    }
}
