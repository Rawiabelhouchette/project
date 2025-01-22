<?php

namespace App\Livewire\Admin\Restaurant;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Restaurant;
use App\Models\Ville;
use App\Utils\AnnoncesUtils;
use App\Utils\Utils;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Create extends Component
{
    use WithFileUploads, AnnonceBaseCreate;

    public $nom;
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;

    public $entrees;
    public $plats;
    public $desserts;

    public $entrees_error = '';
    public $plats_error = '';
    public $desserts_error = '';

    public $equipements_restauration = [];
    public $list_equipements_restauration = [];

    public $specialites = [];
    public $list_specialites = [];

    public $carte_consommation = [];
    public $list_carte_consommation = [];
    public $services = [];
    public $list_services = [];


    public $entreprises = [];

    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public function mount()
    {
        $this->initialization();
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_equipement_restauration = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-restauration')->first();
        $tmp_equipement_restauration ?
            $this->list_equipements_restauration = ReferenceValeur::where('reference_id', $tmp_equipement_restauration->id)->select('valeur', 'id')->get() :
            $this->list_equipements_restauration = [];

        // dd($this->list_equipements_restauration);

        $tmp_specialite = Reference::where('slug_type', 'restauration')->where('slug_nom', 'specialites')->first();
        $tmp_specialite ?
            $this->list_specialites = ReferenceValeur::where('reference_id', $tmp_specialite->id)->select('valeur', 'id')->get() :
            $this->list_specialites = [];

        $tmp_services = Reference::where('slug_type', 'restauration')->where('slug_nom', 'services-proposes')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $tmp_carte_consommation = Reference::where('slug_type', 'restauration')->where('slug_nom', 'boissons-disponibles')->first();
        $tmp_carte_consommation ?
            $this->list_carte_consommation = ReferenceValeur::where('reference_id', $tmp_carte_consommation->id)->select('valeur', 'id')->get() :
            $this->list_carte_consommation = [];

        $this->pays = Pays::all();
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date|after_or_equal:today',
            'entreprise_id' => 'required|integer|exists:entreprises,id',

            // 'entrees' => 'required|array|min:1',
            // 'entrees.*.nom' => 'required|string|min:3',
            // 'entrees.*.ingredients' => 'nullable|string|min:3',
            // 'entrees.*.prix = ' => 'requried|integer|min:0',
            // 'entrees.*.image' => 'nullable|image',

            // 'plats' => 'required|array|min:1',
            // 'plats.*.nom' => 'required|string|min:3',
            // 'plats.*.ingredients' => 'nullable|string|min:3',
            // 'plats.*.prix = ' => 'requried|integer|min:0',
            // 'plats.*.image' => 'nullable|image',

            // 'desserts' => 'required|array|min:1',
            // 'desserts.*.nom' => 'required|string|min:3',
            // 'desserts.*.ingredients' => 'nullable|string|min:3',
            // 'desserts.*.prix = ' => 'requried|integer|min:0',
            // 'desserts.*.image' => 'nullable|image',

            // // 'carte_consommation' => 'nullable|array',
            // // 'carte_consommation.*' => 'nullable|integer|exists:reference_valeurs,id',

            // 'services' => 'nullable',
            'image' => 'required|image',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image',
            
            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'nullable|exists:quartiers,id',
        ];
    }

    public function updatedPaysId($pays_id)
    {
        $this->ville_id = null;
        $this->quartier_id = null;
        $this->villes = Ville::where('pays_id', $pays_id)->get();
    }

    public function updatedVilleId($ville_id)
    {
        $this->quartier_id = null;
        $this->quartiers = Quartier::where('ville_id', $ville_id)->get();
    }


    public function store()
    {
        $this->validate();

        $separator = Utils::getRestaurantValueSeparator();

        $e_nom = '';
        $e_ingredients = '';
        $e_prix_min = '';
        $e_prix_max = '';

        $p_nom = '';
        $p_ingredients = '';
        $p_ingredients = '';
        $p_prix_min = '';
        $p_prix_max = '';

        $d_nom = '';
        $d_ingredients = '';
        $d_prix_min = '';
        $d_prix_max = '';

        // Put all entrees in the same variable
        foreach ($this->entrees as $entree) {
            $e_nom .= $entree['nom'] . $separator;
            $e_ingredients .= $entree['ingredients'] . $separator;
            $e_prix_min .= $entree['prix'] . $separator;
            $e_prix_max .= $entree['prix'] . $separator;
        }

        // Put all plats in the same variable
        foreach ($this->plats as $plat) {
            $p_nom .= $plat['nom'] . $separator;
            $p_ingredients .= $plat['ingredients'] . $separator;
            $p_prix_min .= $plat['prix'] . $separator;
            $p_prix_max .= $plat['prix'] . $separator;
        }

        // Put all desserts in the same variable
        foreach ($this->desserts as $dessert) {
            $d_nom .= $dessert['nom'] . $separator;
            $d_ingredients .= $dessert['ingredients'] . $separator;
            $d_prix_min .= $dessert['prix'] . $separator;
            $d_prix_max .= $dessert['prix'] . $separator;
        }


        try {
            DB::beginTransaction();

            $restaurant = Restaurant::create([
                'e_nom' => $e_nom,
                'e_ingredients' => $e_ingredients,
                'e_prix_min' => $e_prix_min,
                'e_prix_max' => $e_prix_max,

                'p_nom' => $p_nom,
                'p_ingredients' => $p_ingredients,
                'p_prix_min' => $p_prix_min,
                'p_prix_max' => $p_prix_max,

                'd_nom' => $d_nom,
                'd_ingredients' => $d_ingredients,
                'd_prix_min' => $d_prix_min,
                'd_prix_max' => $d_prix_max,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Restaurant',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,

                'ville_id' => $this->ville_id,
                'quartier_id' => $this->quartier_id,
            ]);

            $restaurant->annonce()->save($annonce);

            $references = [
                ['Equipements restauration', $this->equipements_restauration],
                ['Specialités', $this->specialites],
                ['Services proposés', $this->services],
                ['Carte de consommation', $this->carte_consommation],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'restaurants');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        session()->flash('success', 'L\'annonce a bien été ajoutée');
        return redirect()->route('public.annonces.list');
    }


    public function render()
    {
        return view('livewire.admin.restaurant.create');
    }
}
