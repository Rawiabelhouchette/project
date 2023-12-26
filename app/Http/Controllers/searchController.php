<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        $key = $request->input('key');
        $type = $request->input('type');
        return view('public.search', compact('key', 'type'));
    }

    public function show($slug)
    {
        $annonce = Annonce::where('slug', $slug)->where('is_active', true)->where('date_validite', '>=', date('Y-m-d H:i:s'))->firstOrFail();
        $annonces = Annonce::where('type', $annonce->type)->where('is_active', true)->where('date_validite', '>=', date('Y-m-d H:i:s'))->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';
        return view('public.show', compact('annonce', 'type', 'key', 'annonces'));
    }

}
