<?php

namespace App\Http\Controllers;

use App\Models\OffreAbonnement;
use App\Services\Paiement\PaiementService;
use Illuminate\Http\Request;
use Log;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $validated = session()->get('abonnement');

        if (! $validated) {
            return redirect()->route('pricing');
        }

        $offre = OffreAbonnement::find($validated['offre_id']);

        if ($offre->is_free) {
            if (! auth()->user()->hasRole('Usager')) {
                return back()->with('error', 'Votre profil ne peut pas bénéficier de cet abonnement gratuit.');
            }

            $result = PaiementService::addFreeSubscription($validated);

            if (! $result) {
                return back()->with('error', 'Erreur lors de l\'ajout de l\'abonnement.')->withInput($validated);
            }

            session()->forget('abonnement');
            session()->flash('success', 'Abonnement ajouté avec succès.');

            return redirect()->route('public.annonces.create');
        }

        // prix et id de l'utilisateur
        $guichet = PaiementService::getGuichet(auth()->user()->id, $validated);

        if ($guichet->status == 'success') {
            return redirect($guichet->url);
        } else {
            Log::error(''.$guichet->status);

            return back()->with('error', $guichet->message)->withInput([
                'offre_id' => $validated['offre_id'],
                'nom_entreprise' => $validated['nom_entreprise'],
                'numero_telephone' => $validated['numero_telephone'],
                'numero_whatsapp' => $validated['numero_whatsapp'],
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function returnURL() {}

    public function notifyURL() {}
}
