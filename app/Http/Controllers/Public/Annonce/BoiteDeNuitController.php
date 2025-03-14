<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\BoiteDeNuit;
use Illuminate\Http\Request;

class BoiteDeNuitController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.boite-de-nuit');
    }

    public function edit(BoiteDeNuit $nightClub)
    {
        return view('public.user.annonce.edit.boite-de-nuit', [
            'boiteDeNuit' => $nightClub
        ]);
    }
}
