<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\Patisserie;
use Illuminate\Http\Request;

class PatisserieController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.patisserie');
    }

    public function edit(Patisserie $pastryShop)
    {
        $patisserie = $pastryShop;
        return view('public.user.annonce.edit.patisserie', compact('patisserie'));
    }
}
