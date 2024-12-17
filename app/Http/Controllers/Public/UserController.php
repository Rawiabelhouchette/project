<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myBusiness()
    {
        return view('public.user.company.show');
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
