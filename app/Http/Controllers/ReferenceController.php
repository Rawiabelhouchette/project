<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reference.add');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.reference.add');
        // $reference_valeurs = ReferenceValeur::all();
        // return view('admin.reference.list', compact('reference_valeurs'));
    }

    /**
     * Afficher le formulaire pour ajouter un nouveau nom de référence.
     */
    public function create_name()
    {
        return view('admin.reference.add-nom');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verification des champs type, nom et valeur
        $request->validate([
            'type' => 'required|string',
            'nom' => 'required|string',
            'valeur' => 'required|string'
        ]);

        // Verifier si la combinaison type/nom existe
        $reference = Reference::where('type', $request->type)->where('nom', $request->nom)->first();
        if (!$reference) {
            return back()->with('error', 'Cette combinaison type/nom n\'existe pas.');
        }

        // Verifier si la combinaison valeur/ reference_id existe déjà
        $referenceValeur = ReferenceValeur::where('valeur', $request->valeur)->where('reference_id', $reference->id)->first();
        if ($referenceValeur) {
            return back()->with('error', 'Cette combinaison valeur/ reference_id existe déjà.');
        }

        // Enregistrer la nouvelle valeur de référence
        $referenceValeur = new ReferenceValeur();
        $referenceValeur->valeur = $request->valeur;
        $referenceValeur->reference_id = $reference->id;
        $referenceValeur->save();

        return back()->with('success', 'La référence a été ajoutée avec succès.');
    }

    /**
     * Enregistrer un nouveau nom de référence.
     */
    public function store_name(Request $request)
    {
        // Valider les données
        $request->validate([
            'type' => 'required|string',
            'nom' => 'required|min:3'
        ]);

        // Verifier si la combinaison type/nom existe déjà
        $reference = Reference::where('type', $request->type)->where('nom', $request->nom)->first();
        if ($reference) {
            return back()->with('error', 'Cette combinaison type/nom existe déjà.');
        }

        // Enregistrer le nouveau nom de référence
        $reference = new Reference();
        $reference->type = $request->type;
        $reference->nom = $request->nom;
        $reference->save();

        return back()->with('success', 'Le nom de référence a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Edit a reference
        $reference_valeur = ReferenceValeur::find($id);
        return view('admin.reference.edit', compact('reference_valeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Verification des champs type, nom et valeur
        $request->validate([
            'type' => 'required|string',
            'nom' => 'required|string',
            'valeur' => 'required|string'
        ]);

        // Verifier si la combinaison type/nom existe
        $reference = Reference::where('type', $request->type)->where('nom', $request->nom)->first();
        if (!$reference) {
            return back()->with('error', 'Cette combinaison type/nom n\'existe pas.');
        }

        // Verifier s'il y a eu une modification
        $referenceValeur = ReferenceValeur::find($id);
        if ($referenceValeur->valeur == $request->valeur) {
            return redirect()->route('references.index')->with('info', 'Aucune modification apportée.');
        }

        // Verifier si la combinaison valeur/ reference_id existe déjà
        $referenceValeur = ReferenceValeur::where('valeur', $request->valeur)->where('reference_id', $reference->id)->first();
        if ($referenceValeur) {
            return back()->with('error', 'Cette combinaison valeur/reference existe déjà.');
        }

        // Enregistrer la nouvelle valeur de référence
        $referenceValeur = ReferenceValeur::find($id);
        $referenceValeur->valeur = $request->valeur;
        $referenceValeur->save();

        return redirect()->route('references.index')->with('success', 'La référence a été modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Recuperer un nom de référence en fonction de son type
     */
    public function get_name($type): array|Collection
    {
        // Récupérer les données correspondantes à la valeur envoyée
        $references = Reference::where('type', $type)->get();
        return $references;
    }

    public function getNameDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $references = Reference::with('user');

        $searchableColumns = [
            'id',
            'type',
            'nom',
            'created_at',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $references = $references->whereBetween('created_at', $searchDate);
            } else {
                $references = $references->where(function ($query) use ($search, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
                // ->orderBy('id', 'asc');
            }
        }


        $sortableColumns = [
            'id',
            'slug_type',
            'slug_nom',
            'created_by',
            'created_at',
        ];

        // Tri
        if (request()->input('order')) {
            $orders = request()->input('order');
            foreach ($orders as $order) {
                $columnIndex = $order['column']; // Index de la colonne à trier
                $sortBy = $sortableColumns[$columnIndex]; // Nom de la colonne à trier
                $sortOrder = $order['dir']; // Ordre de tri (asc ou desc)

                // Vérifiez si la colonne est autorisée pour le tri
                if (in_array($sortBy, $sortableColumns)) {
                    // Appliquez le tri à la requête
                    $references = $references->orderBy($sortBy, $sortOrder);
                }
            }
        } else {
            // Tri par défaut
            $references = $references->orderBy('id', 'asc');
        }

        $references = $references->paginate($perPage);

        return response()->json(
            [
                'draw' => request()->get('draw'),
                'recordsTotal' => $references->total(),
                'recordsFiltered' => $references->total(),
                'metaData' => [
                    'total' => $references->total(),
                    'per_page' => $references->perPage(),
                    'current_page' => $references->currentPage(),
                    'last_page' => $references->lastPage(),
                    'from' => $references->firstItem(),
                    'to' => $references->lastItem(),
                ],
                'data' => $references->items(),
            ],
            200
        );
    }

    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        $references = ReferenceValeur::with('reference', 'user')
            ->join('references', 'reference_valeurs.reference_id', '=', 'references.id');

        $searchableColumns = [
            'reference_valeurs.id',
            // 'type',
            // 'nom',
            'reference_valeurs.valeur',
        ];

        if (request()->input('search')) {
            $search = request()->input('search');
            $searchDate = Utils::getStartAndEndOfDay($search);

            if ($searchDate[0] && $searchDate[1]) {
                $references = $references->whereBetween('created_at', $searchDate);
            } else {
                $references = $references->where(function ($query) use ($search, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $search . '%');
                    }
                })
                    ->orWhereHas('reference', function ($query) use ($search) {
                        $query->where('type', 'like', '%' . $search . '%');
                        $query->orWhere('nom', 'like', '%' . $search . '%');
                    });
            }
        }

        $sortableColumns = [
            'reference_valeurs.id',
            'references.type',
            'references.nom',
            'reference_valeurs.valeur',
            'reference_valeurs.created_at',
        ];

        // Tri
        if (request()->input('order')) {
            $orders = request()->input('order');
            foreach ($orders as $order) {
                switch ($order['column']) {
                    case 1:
                        $sortBy = 'slug_type';
                        $references = $references->orderBy('references.slug_type', $order['dir']);
                        break;
                    case 2:
                        $sortBy = 'slug_nom';
                        $references = $references->orderBy('references.slug_nom', $order['dir']);
                        break;
                    default:
                        $columnIndex = $order['column']; // Index de la colonne à trier
                        if (!in_array($columnIndex, [0, 3, 4])) {
                            break;
                        }

                        $sortBy = $sortableColumns[$columnIndex]; // Nom de la colonne à trier
                        $sortOrder = $order['dir']; // Ordre de tri (asc ou desc)

                        if (in_array($sortBy, $sortableColumns)) {
                            // Appliquez le tri à la requête
                            $references = $references->orderBy($sortBy, $sortOrder);
                        }
                        break;
                }
            }
        } else {
            // Tri par défaut
            $references = $references->orderBy('references.id', 'asc');
        }

        $references = $references->select('reference_valeurs.*');

        $references = $references->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $references->total(),
                'recordsFiltered' => $references->total(),
                'data' => $references->items(),
            ],
            200
        );
    }

}


