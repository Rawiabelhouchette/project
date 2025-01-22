<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Utils\AnnoncesUtils;
use Auth;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function createAnnonce()
    {
        // check if entreprise has a quartier attribute
        if (Auth::user()->hasRole('Professionnel')) {
            $entrepises = Auth::user()->entreprises;
            // dd($entrepises);
            foreach ($entrepises as $entreprise) {
                if (!$entreprise->quartier_id) {
                    // if user is entreprise admin
                    if ($entreprise->pivot->is_admin) {
                        // return redirect()->route('entreprises.edit', $entreprise->id)->with('error', 'Veuillez renseigner le quartier de votre entreprise');
                        return redirect()->route('entreprises.edit', $entreprise->id)->with('error', 'Veuillez compléter les informations de votre entreprise');
                    } else {
                        return redirect()->back()->with('error', 'Veuillez compléter les informations de votre entreprise');
                    }
                }
            }
        }

        $typeAnnonces = AnnoncesUtils::getAnnonceListAlt();
        return view('public.user.annonce.create', compact('typeAnnonces'));
    }

    public function listAnnonces()
    {
        return view('public.user.annonce.index');
    }
}
