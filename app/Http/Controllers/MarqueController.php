<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index()
    {
        return view('admin.vehicule.index');
    }
}
