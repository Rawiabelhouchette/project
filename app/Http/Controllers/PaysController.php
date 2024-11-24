<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Http\Requests\StorePaysRequest;
use App\Http\Requests\UpdatePaysRequest;
use App\Utils\Utils;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = Pays::all();
        return view('admin.localisation.pays.index', compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.localisation.pays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaysRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Pays $pays)
    {
        dd('show');
        dd($pays->id);
        return view('admin.localisation.pays.edit', compact('pays'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pays $pay)
    {
        return view('admin.localisation.pays.edit', compact('pay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaysRequest $request, Pays $pays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pays $pays)
    {
        //
    }

    /**
     * Get the data for the datatable
     */
    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $pays = Pays::with('creator');

        $searchableColumns = [
            'id',
            'indicatif',
            'nom',
            'code',
            'langue',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $pays = $pays->whereBetween('created_at', $searchDate);
            } else {
                $pays = $pays->where(function ($query) use ($search, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
        }

        $sortableColumns = [
            'id',
            'indicatif',
            'slug',
            'code',
            'langue',
            'created_at',
        ];

        // Tri
        if (request()->input('order')) {
            $orders = request()->input('order');
            foreach ($orders as $order) {
                $columnIndex = $order['column']; // Index de la colonne à trier
                $sortBy = $sortableColumns[$columnIndex]; // Nom de la colonne à trier
                $sortOrder = $order['dir']; // Ordre de tri (asc ou desc)

                if (in_array($sortBy, $sortableColumns)) {
                    // Appliquez le tri à la requête
                    $pays = $pays->orderBy($sortBy, $sortOrder);
                }
            }
        } else {
            // Tri par défaut
            $pays = $pays->orderBy('id', 'asc');
        }

        $pays = $pays->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $pays->total(),
                'recordsFiltered' => $pays->total(),
                'data' => $pays->items(),
            ],
            200
        );
    }
}
