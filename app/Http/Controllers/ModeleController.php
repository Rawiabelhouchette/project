<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeleController extends Controller
{
    public function index()
    {
        return view('admin.modele.index');
    }

    /**
     * Get the data for the datatable
     */
    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $ville = Ville::with('creator', 'pays');

        $searchableColumns = [
            'id',
            'nom',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $ville = $ville->whereBetween('created_at', $searchDate);
            } else {
                $ville = $ville->where(function ($query) use ($search, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $search . '%');
                    }
                })
                    ->orWhereHas('pays', function ($query) use ($search) {
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
                    $ville = $ville->orderBy($sortBy, $sortOrder);
                }
            }
        } else {
            // Tri par défaut
            $ville = $ville->orderBy('id', 'asc');
        }

        $ville = $ville->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $ville->total(),
                'recordsFiltered' => $ville->total(),
                'data' => $ville->items(),
            ],
            200
        );
    }
}
