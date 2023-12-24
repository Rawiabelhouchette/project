<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Entreprise;
use App\Utils\AnnoncesUtils;
use Illuminate\Http\Request;

class publicController extends Controller
{
    public function home() {
        $listAnnonce = AnnoncesUtils::getPublicAnnonceList();
        $typeAnnonce = Annonce::pluck('type')->unique()->toArray();
        $annonces = Annonce::with('annonceable', 'entreprise')->inRandomOrder()->where('is_active', true)->where('date_validite', '>=', date('Y-m-d H:i:s'))->take(6)->get();
        
        $statsAnnonce = [];
        foreach ($typeAnnonce as $type) {
            $statsAnnonce[] = (object) [
                'type' => $type,
                'count' => Annonce::where('type', $type)->count()
            ];
        }

        return view('public.home', compact(
            'listAnnonce',
            'typeAnnonce', 
            'annonces',
            'statsAnnonce'
        ));
    }

    public function showEntreprise($slug) {
        // dd($slug);
        $entreprise = Entreprise::where('slug', $slug)->firstOrFail();
        $annonces = Annonce::with('annonceable', 'entreprise')->where('entreprise_id', $entreprise->id)->where('is_active', true)->where('date_validite', '>=', date('Y-m-d H:i:s'))->get();
        return view('public.company', compact('entreprise', 'annonces'));
    }
}
