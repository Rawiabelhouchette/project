<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('public.account');
    }

    public function indexFavoris()
    {
        $user = User::find(auth()->user()->id);
        $annonces = $user->favorisAnnonces()->paginate(2);
        // $annonces = $user->favorisAnnonces()->paginate(10);
        return view('public.favoris', compact('annonces'));
    }
}
