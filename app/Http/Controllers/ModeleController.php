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
        $modele = Modele::with('creator', 'marque'); 

        $searchableColumns = [
            'nom',
            'created_at',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $modele->whereBetween('created_at', $searchDate); 
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
            'id',
            'marque_id',
            'nom',
            'created_at',
        ];

        if (request()->input('order')) {
            $orders = request()->input('order');
            foreach ($orders as $order) {
                $columnIndex = $order['column']; 
                $sortBy = $sortableColumns[$columnIndex]; 
                $sortOrder = $order['dir']; 

                if (in_array($sortBy, $sortableColumns)) {
                    $modele = $modele->orderBy($sortBy, $sortOrder); 
                }
            }
        } else {
            $modele = $modele->orderBy('id', 'asc'); 
        }

        $modele = $modele->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $modele->total(), 
                'recordsFiltered' => $modele->total(), 
                'data' => $modele->items(), 
            ],
            200
        );
    }
}
