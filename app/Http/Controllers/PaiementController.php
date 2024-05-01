<?php

namespace App\Http\Controllers;

use App\Models\OffreAbonnement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = session()->get('abonnement');
        if (!$validated) {
            return redirect()->route('pricing');
        }
        $offre = OffreAbonnement::findOrFail($validated['offre_id']);
        return view('payment.check', [
            'request' => $validated,
            'offre' => $offre->id,
            'apikey' => '7609021466630b6ca460e04.60749295',
            'site_id' => '5871411',
            'montant' => mt_rand($offre->prix, $offre->prix),
        ]);
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
}
