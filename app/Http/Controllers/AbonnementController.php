<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffreAbonnementRequest;
use App\Models\Abonnement;
use App\Models\Entreprise;
use App\Models\OffreAbonnement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AbonnementController extends Controller
{
    public function choiceIndex()
    {
        if (!\auth()->check()) {
            return redirect()->route('connexion');
        }

        if (!\auth()->user()->hasRole('Usager')) {
            // return redirect()->route('accueil');
            return back();
        }

        $offres = OffreAbonnement::active()->get();
        return view('public.pricing', compact('offres'));
    }

    public function index()
    {
        // dd(\Auth::user()->abonnements()->get());
        // dd($abonnements = Abonnement::latest());
        return view('admin.abonnement.index');
    }

    public function store(StoreOffreAbonnementRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            // create entreprise
            $entreprise = Entreprise::create([
                'nom' => $request->nom_entreprise,
                'telephone' => $request->numero_telephone,
                'whatsapp' => $request->numero_whatsapp,
            ]);

            // set the user entreprise_id
            \auth()->user()->entreprises()->attach($entreprise->id, [
                'is_admin' => true,
                'is_active' => true,
                'date_debut' => now(),
            ]);

            // create a new abonnement
            $abonnement = Abonnement::create([
                'offre_abonnement_id' => $request->offer_id,
                'date_debut' => now(),
                'date_fin' => now()->addMonths(OffreAbonnement::find($request->offer_id)->duree),
            ]);

            // link the abonnement to the entreprise
            $abonnement->entreprises()->attach($entreprise->id);

            // Get the user
            $user  = User::find(\auth()->id());

            // remove role Usager
            $user->removeRole('Usager');
            $user->assignRole('Professionnel');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement de votre abonnement');
        }

        return redirect()->route('home');
    }

    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        if (\Auth::user()->hasRole('Professionnel')) {
            $abonnements = \Auth::user()->abonnements();
        } else {
            $abonnements = Abonnement::latest();
        }

        $columns = Schema::getColumnListing('abonnements');

        if (request()->input('search')) {
            $search_columns = ['date_debut', 'date_fin'];
            $search = request()->input('search');
            $abonnements = $abonnements
                ->where(function ($query) use ($search, $columns, $search_columns) {
                    // foreach ($search_columns as $column) {
                    //     $query->orWhereRaw("LOWER({$column}) LIKE ?", ['%' . Str::lower($search) . '%']);
                    // }

                    // $query->orWhereHas('entreprises', function ($query) use ($search) {
                    //     $query->whereRaw("LOWER(nom) LIKE ?", ['%' . Str::lower($search) . '%']);
                    // });

                    // $query->orWhereHas('offre', function ($query) use ($search) {
                    //     $query->whereRaw("LOWER(libelle) LIKE ?", ['%' . Str::lower($search) . '%']);
                    // });

                    // if (Str::lower($search) == 'actif') {
                    //     $query->orWhere('is_active', true);
                    // } elseif (Str::lower($search) == 'inactif') {
                    //     $query->orWhere('is_active', false);
                    // }
                })
                ->orderBy('id', 'asc');
        }
        $abonnements = $abonnements->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $abonnements->total(),
                'recordsFiltered' => $abonnements->total(),
                'data' => $abonnements->items(),
            ],
            200,
        );
    }
}
