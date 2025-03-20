<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myBusiness()
    {
        session()->flash('success', 'Ceci est un test1');
        // dd(session()->all());
        $user = auth()->user();
        return view('public.user.company.show', [
            'entreprise' => $user->entreprises()->first(),
            'annonces' => $user->annonces()->limit(5)->get(),
        ]);
    }

    public function editMyBusiness()
    {
        return view('public.user.company.edit', [
            'entreprise' => auth()->user()->entreprises()->first(),
        ]);
    }

    public function myAccount()
    {
        return view('public.user.account.show');
    }

    public function myComments()
    {
        return view('public.user.comments');
    }

    public function myFavorites()
    {
        return view('public.user.favorites');
    }
}
