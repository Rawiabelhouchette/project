<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Document;
use App\Models\Message;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Session as ModelsSession;

class AdminController extends Controller
{
    public function welcome()
    {
        $sexes = null;//Reference::where('type', 'Comptes')->where('nom', 'Sexe')->first();
        return view('welcome', compact('sexes'));
    }


    public function home()
    {
        //     $documents = Document::all()->count();
        //     $comptes = Compte::all()->count();
        //     $references = ReferenceValeur::all()->count();
        //     $messages = Message::where('repondu', false)->count();
        //     $activeUserKeys = ModelsSession::where('last_activity', '>=', now()->subMinutes(5)->timestamp)->where('is_public', 1)->count();
        //     $consultations = Document::where('is_public', 1)->sum('nbre_consultation');
        //     $elements = [
        //         [
        //             'id' => 'documents',
        //             'nombre' => $documents,
        //             'nom' => 'Documents',
        //             'lien' => 'documents.index',
        //             'icon' => 'fa-solid fa-book',
        //             'couleur' => '#3390FF'
        //         ],
        //         [
        //             'id' => 'comptes',
        //             'nombre' => $comptes,
        //             'nom' => 'Comptes',
        //             'lien' => 'comptes.index',
        //             'icon' => 'fa-solid fa-users',
        //             'couleur' => '#33FFA8'
        //         ],
        //         [
        //             'id' => 'references',
        //             'nombre' => $references,
        //             'nom' => 'Références',
        //             'lien' => 'references.index',
        //             'icon' => 'fa-solid fa-asterisk',
        //             'couleur' => '#FF3383'
        //         ],
        //         [
        //             'id' => 'connexions',
        //             'nombre' => $activeUserKeys,
        //             'nom' => 'Connexions publiques',
        //             'lien' => '',
        //             'icon' => 'fa-solid fa-right-to-bracket',
        //             'couleur' => '#EBC855'
        //         ],
        //         [
        //             'id' => 'messages',
        //             'nombre' => $messages,
        //             'nom' => 'Messages',
        //             'lien' => 'staff.messages.index',
        //             'icon' => 'fa-solid fa-envelope',
        //             'couleur' => '#E291EC'
        //         ],
        //         [
        //             'id' => 'consultations',
        //             'nombre' => $consultations,
        //             'nom' => 'Consultations',
        //             'lien' => '',
        //             'icon' => 'fa-solid fa-eye',
        //             'couleur' => '#374259'
        //         ],
        //     ];
        //     return view('admin.dashboard', compact('elements'));

        if (auth()->user()->hasRole('Usager')) {
            return redirect()->route('accounts.index');
        }

        return view('admin.dashboard');
    }
}
