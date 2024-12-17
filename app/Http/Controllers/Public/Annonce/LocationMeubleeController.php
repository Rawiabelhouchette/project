<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationMeubleeController extends Controller
{
    public function create()
    {
        return view('public.annonce.create.location-meublee');
    }
}
