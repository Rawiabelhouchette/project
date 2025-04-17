<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Http\Requests\StoreQuartierRequest;
use App\Http\Requests\UpdateQuartierRequest;
use App\Utils\Utils;

class QuartierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quartiers = Quartier::with('ville')->get();
        return view("admin.localisation.quartier.index", compact("quartiers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.localisation.quartier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuartierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quartier $quartier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quartier $quartier)
    {
        return view("admin.localisation.quartier.edit", compact("quartier"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuartierRequest $request, Quartier $quartier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quartier $quartier)
    {
        //
    }

    public function localisation()
    {
        $quartiers = Quartier::with("ville")->get();
        return view("admin.localisation.index", compact("quartiers"));
    }

    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $quartiers = Quartier::with('creator', 'ville', 'ville.pays');

        $searchableColumns = [
            'id',
            'nom',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $quartiers = $quartiers->whereBetween('created_at', $searchDate);
            } else {
                $quartiers = $quartiers->where(function ($query) use ($search, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $search . '%');
                    }
                })
                    ->orWhereHas('ville', function ($query) use ($search) {
                        $query->where('nom', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('ville.pays', function ($query) use ($search) {
                        $query->where('nom', 'like', '%' . $search . '%');
                    });
            }
        }

        $sortableColumns = [
            'id',
            'indicatif',
            'nom',
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
                    $quartiers = $quartiers->orderBy($sortBy, $sortOrder);
                }
            }
        } else {
            // Tri par défaut
            $quartiers = $quartiers->orderBy('id', 'asc');
        }

        $quartiers = $quartiers->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $quartiers->total(),
                'recordsFiltered' => $quartiers->total(),
                'data' => $quartiers->items(),
            ],
            200
        );
    }
}
