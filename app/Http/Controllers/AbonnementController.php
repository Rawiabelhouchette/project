<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    public function choiceIndex()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        if (!auth()->user()->hasRole('Usager')) {
            // return redirect()->route('accueil');
            return back();
        }
        return view('public.pricing');
    }
}
