<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoiteDeNuitController extends Controller
{
    public function create()
    {
        return view('public.annonce.create.boite-de-nuit');
    }
}
