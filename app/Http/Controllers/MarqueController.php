<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Utils\Utils;

class MarqueController extends Controller
{
    public function index()
    {
        return view('admin.marque.index');
    }

    /**
     * Get the data for the datatable
     */
    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $marque = Marque::with('creator');

        $searchableColumns = [
            'id',
            'nom',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $marque = $marque->whereBetween('created_at', $searchDate);
            } else {
                $marque = $marque->where(function ($query) use ($search, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $query->orWhere($column, 'like', '%'.$search.'%');
                    }
                });
            }
        }

        $sortableColumns = [
            'id',
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
                    $marque = $marque->orderBy($sortBy, $sortOrder);
                }
            }
        } else {
            // Tri par défaut
            $marque = $marque->orderBy('id', 'asc');
        }

        $marque = $marque->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $marque->total(),
                'recordsFiltered' => $marque->total(),
                'data' => $marque->items(),
            ],
            200
        );
    }
}
