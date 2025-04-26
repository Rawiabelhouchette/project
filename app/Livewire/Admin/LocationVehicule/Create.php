<?php

namespace App\Livewire\Admin\LocationVehicule;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\LocationVehicule;
use App\Models\Entreprise;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Ville;
use App\Utils\AnnoncesUtils;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, AnnonceBaseCreate;

    public $nom;
    public $type;
    public $description;
    public $marque_id;
    public $modele_id;
    public $annee;
    public $carburant;
    public $kilometrage;
    public $boite_vitesses;
    public $nombre_portes;
    public $nombre_places;

    public $entreprise_id;
    public $entreprises = [];

    public $types_vehicule = [];
    public $list_types_vehicule = [];

    public $equipements_vehicule = [];
    public $list_equipements_vehicule = [];

    public $list_boites_vitesse = [];
    public $list_marques = [];
    public $list_modeles = [];
    public $list_types_carburant = [];

    public $conditions_location = [];
    public $list_conditions_location = [];
    public $date_validite;
    public $heure_validite;

    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public $latitude;
    public $longitude;


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

        $tmp_type_vehicule = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'types-de-voiture')->first();
        $tmp_type_vehicule ?
            $this->list_types_vehicule = ReferenceValeur::where('reference_id', $tmp_type_vehicule->id)->select('valeur', 'id')->get() :
            $this->list_types_vehicule = [];

        $tmp_equipement_vehicule = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'options-accessoires')->first();
        $tmp_equipement_vehicule ?
            $this->list_equipements_vehicule = ReferenceValeur::where('reference_id', $tmp_equipement_vehicule->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vehicule = [];

        $tmp_boite_vitesse = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'boite-de-vitesses')->first();
        $tmp_boite_vitesse ?
            $this->list_boites_vitesse = ReferenceValeur::where('reference_id', $tmp_boite_vitesse->id)->select('valeur', 'id')->get() :
            $this->list_boites_vitesse = [];

        $tmp_condition_location = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'conditions-de-location')->first();
        $tmp_condition_location ?
            $this->list_conditions_location = ReferenceValeur::where('reference_id', $tmp_condition_location->id)->select('valeur', 'id')->get() :
            $this->list_conditions_location = [];

        $this->list_marques = Marque::orderBy('nom')->get();

        $tmp_type_carburant = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'types-moteur')->first();
        $tmp_type_carburant ?
            $this->list_types_carburant = ReferenceValeur::where('reference_id', $tmp_type_carburant->id)->select('valeur', 'id')->get() :
            $this->list_types_carburant = [];

        $this->pays = Pays::orderBy('nom')->get();

        $this->date_validite = auth()->user()->activeAbonnements()->date_fin->format('Y-m-d');
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'modele_id' => 'required|exists:modeles,id',
            'annee' => 'nullable|integer|min:1800|max:9999',
            'carburant' => 'nullable|string|exists:reference_valeurs,valeur',
            'kilometrage' => 'nullable|integer|min:0|max:999999',
            'boite_vitesses' => 'nullable|string|exists:reference_valeurs,valeur',
            'nombre_portes' => 'nullable|integer|min:0|max:20',
            'nombre_places' => 'nullable|integer|min:0|max:100',
            'types_vehicule' => 'nullable|array',
            'types_vehicule.*' => 'nullable|integer|exists:reference_valeurs,id',
            'equipements_vehicule' => 'nullable|array',
            'equipements_vehicule.*' => 'nullable|integer|exists:reference_valeurs,id',
            'conditions_location' => 'nullable|array',
            'conditions_location.*' => 'nullable|integer|exists:reference_valeurs,id',
            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required|string|max:255',

            'longitude' => 'required|string',
            'latitude' => 'required|string',

            'image' => 'required|image|max:5120|mimes:jpeg,png,jpg,heic',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg,heic',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Veuillez choisir une entreprise'),
            'entreprise_id.exists' => __('Veuillez choisir une entreprise valide'),

            'nom.required' => __('Veuillez renseigner le nom'),
            'nom.string' => __('Nom invalide'),
            'nom.min' => __('Le nom doit contenir au moins :min caractères'),
            'nom.max' => __('Le nom doit contenir au maximum :max caractères'),
            'nom.unique' => __('Ce nom existe déjà'),

            'description.required' => __('Veuillez renseigner la description'),
            'description.string' => __('Description invalide'),
            'description.min' => __('La description doit contenir au moins :min caractères'),
            'description.max' => __('La description doit contenir au maximum :max caractères'),

            'modele_id.required' => __('Veuillez choisir un modèle'),
            'modele_id.exists' => __('Veuillez choisir un modèle valide'),

            'annee.integer' => __('Année invalide'),
            'annee.min' => __('L\'année doit être supérieure ou égale à :min'),
            'annee.max' => __('L\'année doit être inférieure ou égale à :max'),

            'carburant.integer' => __('Type de carburant invalide'),
            'carburant.exists' => __('Type de carburant invalide'),

            'kilometrage.integer' => __('Kilométrage invalide'),
            'kilometrage.min' => __('Le kilométrage doit être supérieur ou égal à :min'),
            'kilometrage.max' => __('Le kilométrage doit être inférieur ou égal à :max'),

            'boite_vitesses.integer' => __('Boite de vitesse invalide'),
            'boite_vitesses.exists' => __('Boite de vitesse invalide'),

            'nombre_portes.integer' => __('Nombre de portes invalide'),
            'nombre_portes.min' => __('Le nombre de portes doit être supérieur ou égal à :min'),
            'nombre_portes.max' => __('Le nombre de portes doit être inférieur ou égal à :max'),
            'pays_id.required' => 'Le pays est obligatoire',
            'pays_id.exists' => 'Le pays n\'existe pas',
            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville n\'existe pas',
            'quartier_id.required' => 'Le quartier est obligatoire',

            'longitude.required' => 'La localisation est obligatoire.',

            'image.required' => 'L\'image est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.max' => 'Le fichier ne doit pas dépasser :max Mo',
            'image.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou heic',

            'galerie.*.image' => 'Le fichier doit être une image',
            'galerie.*.max' => 'Le fichier ne doit pas dépasser 5 Mo',
            'galerie.max' => 'Vous ne pouvez pas charger plus de :max images',
            'galerie.*.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou heic',
        ];
    }

    #[On('setLocation')]
    public function setLocation($location)
    {
        $this->longitude = (String) $location['lon'];
        $this->latitude = (String) $location['lat'];
    }

    public function updatedPaysId($pays_id)
    {
        $this->ville_id = null;
        $this->quartier_id = null;
        $this->villes = Ville::where('pays_id', $pays_id)->orderBy('nom')->get();
    }

    public function updatedVilleId($ville_id)
    {
        $this->quartier_id = null;
        $this->quartiers = Quartier::where('ville_id', $ville_id)->orderBy('nom')->get();
    }

    public function updatedMarqueId($marque_id)
    {
        $this->modele_id = null;
        $this->list_modeles = Modele::where('marque_id', $marque_id)->orderBy('nom')->get();
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $locationVehicule = LocationVehicule::create([
                'annee' => $this->annee,
                'carburant' => $this->carburant,
                'kilometrage' => $this->kilometrage,
                'boite_vitesse' => $this->boite_vitesses,
                'nombre_portes' => $this->nombre_portes,
                'nombre_places' => $this->nombre_places,
                'entreprise_id' => $this->entreprise_id,
                'modele_id' => $this->modele_id,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'description' => $this->description,
                'entreprise_id' => $this->entreprise_id,
                'type' => 'Location de véhicule',

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,

                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            $locationVehicule->annonce()->save($annonce);

            $references = [
                ['Types de voiture', $this->types_vehicule],
                ['Options et accessoires', $this->equipements_vehicule],
                ['Conditions de location', $this->conditions_location],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'location-vehicules');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        session()->flash('success', __('Annonce enregistrée avec succès'));
        return redirect()->route('public.annonces.list');
    }


    public function render()
    {
        return view('livewire.admin.location-vehicule.create');
    }
}
