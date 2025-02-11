<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\FastFood;
use Illuminate\Http\Request;

class FastFoodController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.fast-food');
    }

    public function edit(FastFood $fastFood)
    {
        return view('public.user.annonce.edit.fast-food', compact('fastFood'));
    }
}
