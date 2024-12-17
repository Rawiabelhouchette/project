<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AubergeController extends Controller
{
    public function index()
    {
        // return view('public.annonce.auberge.index');
    }

    public function create()
    {
        return view('public.annonce.create.auberge');
    }
}
