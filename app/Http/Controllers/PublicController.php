<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Quartier;
use App\Utils\AnnoncesUtils;
use App\Utils\CustomSession;
use Auth;

class PublicController extends Controller
{
    public function home()
    {
        $listAnnonce = AnnoncesUtils::getPublicAnnonceList();
        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();
        $annonces = Annonce::public()->with('annonceable', 'entreprise')->inRandomOrder()->take(6)->get();

        // dd($annonces);
        $statsAnnonce = [];
        $quartiers = Quartier::getAllQuartiers();
        foreach ($typeAnnonce as $type) {
            $statsAnnonce[] = (object) [
                'type' => $type,
                'count' => Annonce::where('type', $type)->count()
            ];
        }

        // order by count
        usort($statsAnnonce, function ($a, $b) {
            return $a->count < $b->count;
        });

        CustomSession::reset();

        return view(
            'public.home',
            compact(
                'listAnnonce',
                'typeAnnonce',
                'annonces',
                'statsAnnonce',
                'quartiers'
            )
        );
    }

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

        $typeAnnonces = AnnoncesUtils::getAnnonceList();
        return view('public.annonce.create', compact('typeAnnonces'));
    }

    public function showEntreprise($slug)
    {
        $entreprise = Entreprise::where('slug', $slug)->firstOrFail();
        $annonces = Annonce::public()->with('annonceable', 'entreprise')->where('entreprise_id', $entreprise->id)->take(4)->get();
        return view('public.company', compact('entreprise', 'annonces'));
    }
}
