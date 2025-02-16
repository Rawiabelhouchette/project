<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.restaurant');
    }

    public function edit()
    {
        return view('public.user.annonce.edit.restaurant');
    }
}
