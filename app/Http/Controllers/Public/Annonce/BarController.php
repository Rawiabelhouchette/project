<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\Bar;

class BarController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.bar');
    }

    public function edit(Bar $bar)
    {
        return view('public.user.annonce.edit.bar', compact('bar'));
    }
}
