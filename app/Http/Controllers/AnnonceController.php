<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;
use Illuminate\Support\Facades\Schema;
use App\Utils\Annonces;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.annonce.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeAnnonces = Annonces::getAnnonceList();
        return view('admin.annonce.create', compact('typeAnnonces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnonceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnonceRequest $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        //
    }

    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $annonces = Annonce::latest();
        $columns = Schema::getColumnListing('annonces');

        if (request()->input('search')) {
            $search = request()->input('search');
            $annonces = $annonces
                ->where(function ($query) use ($search, $columns) {
                    foreach ($columns as $column) {
                        $query->orWhere($column, 'like', '%' . $search . '%');
                    }
                })
                ->orderBy('id', 'asc');
        }
        $annonces = $annonces->with('entreprise', 'annonceable');
        $annonces = $annonces->paginate($perPage);

        return response()->json(
            [
                'draw' => request()->get('draw'),
                'recordsTotal' => $annonces->total(),
                'recordsFiltered' => $annonces->total(),
                'metaData' => [
                    'total' => $annonces->total(),
                    'per_page' => $annonces->perPage(),
                    'current_page' => $annonces->currentPage(),
                    'last_page' => $annonces->lastPage(),
                    'from' => $annonces->firstItem(),
                    'to' => $annonces->lastItem(),
                ],
                'data' => $annonces->items(),
            ],
            200,
        );
    }
}
