<?php

namespace App\Http\Controllers\Public\Annonce;

use App\Http\Controllers\Controller;
use App\Models\Auberge;
use Illuminate\Http\Request;

class AubergeController extends Controller
{
    public function create()
    {
        return view('public.user.annonce.create.auberge');
    }

    public function edit(Auberge $hostel)
    {
        return view('public.user.annonce.edit.auberge', [
            'auberge' => $hostel
        ]);
    }
}
