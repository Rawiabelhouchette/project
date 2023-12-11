<?php

namespace App\Http\Controllers;

use App\Models\locationMeublee;
use App\Http\Requests\StorelocationMeubleeRequest;
use App\Http\Requests\UpdatelocationMeubleeRequest;

class locationMeubleeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location-meublee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelocationMeubleeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(locationMeublee $locationMeublee)
    {
        return view('admin.location-meublee.show', compact('locationMeublee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(locationMeublee $locationMeublee)
    {
        return view('admin.location-meublee.edit', compact('locationMeublee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelocationMeubleeRequest $request, locationMeublee $locationMeublee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(locationMeublee $locationMeublee)
    {
        //
    }
}
