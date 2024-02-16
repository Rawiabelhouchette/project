<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\StatistiqueAnnonce;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        return view('public.search', [
            'filter' => (object) $request->all(),
        ]);
    }

    public function show($slug)
    {
        $annonce = Annonce::public()->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $annonces = Annonce::public()->where('type', $annonce->type)->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';
        // increement statistiqueAnnonce nb_vue
        $stat = StatistiqueAnnonce::where('annonce_id', $annonce->id)->first();
        $stat->increment('nb_vue');

        return view('public.show', compact('annonce', 'type', 'key', 'annonces'));
    }

}
