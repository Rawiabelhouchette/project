<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.hotel');
    }

    public function edit(Hotel $hotel)
    {
        return view('public.user.annonce.edit.hotel', [
            'hotel' => $hotel,
        ]);
    }
}
