<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\StatistiqueAnnonce;
use App\Utils\CustomSession;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        // CustomSession::clear();
        // CustomSession::create([
        //     'key' => $request->input('key'),
        //     'type' => $request->input('type'),
        //     'url' => url()->current(),
        // ]);

        return view('public.search', [
            'filter' => (object) $request->all(),
        ]);
    }

    public function show($slug)
    {
        $annonce = Annonce::getActiveAnnonces()->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $annonces = Annonce::getActiveAnnonces()->where('type', $annonce->type)->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';
        // increement statistiqueAnnonce nb_vue
        $stat = StatistiqueAnnonce::where('annonce_id', $annonce->id)->first();
        $stat->increment('nb_vue');

        return view('public.show', compact('annonce', 'type', 'key', 'annonces'));
    }

}
