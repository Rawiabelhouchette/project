<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Compte;
use App\Models\Document;
use App\Models\Message;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Session as ModelsSession;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function welcome()
    {
        $sexes = null;//Reference::where('type', 'Comptes')->where('nom', 'Sexe')->first();
        return view('welcome', compact('sexes'));
    }


    public function home()
    {
        if (Auth::user()->hasRole('Professionnel')) {
            $annonces = Auth::user()->annonces()->count();
        } else {
            $annonces = Annonce::with('entreprise', 'annonceable')->count();
        }

        $elements = [
            [
                'id' => 'annonce',
                'nombre' => $annonces,
                'nom' => 'Annonces',
                'lien' => 'documents.index',
                'icon' => 'fa-solid fa-book',
                'couleur' => '#3390FF'
            ],
            // [
            //     'id' => 'comptes',
            //     'nombre' => 0,
            //     'nom' => 'Comptes',
            //     'lien' => 'comptes.index',
            //     'icon' => 'fa-solid fa-users',
            //     'couleur' => '#33FFA8'
            // ],
            // [
            //     'id' => 'references',
            //     'nombre' => 0,
            //     'nom' => 'Références',
            //     'lien' => 'references.index',
            //     'icon' => 'fa-solid fa-asterisk',
            //     'couleur' => '#FF3383'
            // ],
        ];

        if (auth()->user()->hasRole('Usager')) {
            return redirect()->route('accounts.index');
        }

        return view('admin.dashboard', compact('elements'));
    }
}
