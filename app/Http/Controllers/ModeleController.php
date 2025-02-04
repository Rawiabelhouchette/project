<?php

namespace App\Http\Controllers;

use App\Utils\Utils;
use Illuminate\Http\Request;
use App\Models\Modele;

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
        $modele = Modele::with('creator', 'marque'); // Change 'Ville' to 'Modele'

        $searchableColumns = [
            // 'id',
            'nom',
            'created_at',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $modele->whereBetween('created_at', $searchDate); // Change 'ville' to 'modele'
            } else {
                $modele
                    ->where(function ($query) use ($search, $searchableColumns) {
                        foreach ($searchableColumns as $column) {
                            $query->orWhere($column, 'like', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('marque', function ($query) use ($search) {
                        $query->where('nom', 'like', '%' . $search . '%');
                    });
            }
        }

        $sortableColumns = [
            // 'id',
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
                    $modele = $modele->orderBy($sortBy, $sortOrder); // Change 'ville' to 'modele'
                }
            }
        } else {
            // Tri par défaut
            $modele = $modele->orderBy('id', 'asc'); // Change 'ville' to 'modele'
        }

        $modele = $modele->paginate($perPage); // Change 'ville' to 'modele'

        return response()->json(
            [
                'recordsTotal' => $modele->total(), // Change 'ville' to 'modele'
                'recordsFiltered' => $modele->total(), // Change 'ville' to 'modele'
                'data' => $modele->items(), // Change 'ville' to 'modele'
            ],
            200
        );
    }
}
