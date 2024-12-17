<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.bar');
    }
}
