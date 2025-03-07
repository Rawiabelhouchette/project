<?php

namespace App\Livewire\Admin\LocationVehicule;

use App\Livewire\Admin\AnnonceBaseEdit;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Ville;
use App\Utils\AnnoncesUtils;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Entreprise;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $nom;
    public $type;
    public $description;
    public $marque_id;
    public $modele_id;
    public $annee;
    public $carburant;
    public $kilometrage;
    public $boite_vitesse;
    public $nombre_portes;
    public $nombre_places;
    public $is_active;
    public $locationVehicule;

    public $entreprise_id;
    public $entreprises = [];

    public $types_vehicule = [];
    public $list_types_vehicule = [];

    public $equipements_vehicule = [];
    public $list_equipements_vehicule = [];

    public $list_boites_vitesse = [];
    public $boite_vitesses;

    public $list_marques = [];
    public $list_modeles = [];
    public $list_types_carburant = [];

    public $conditions_location = [];
    public $list_conditions_location = [];

    public $date_validite;
    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public $latitude;
    public $longitude;

    public function mount($locationVehicule)
    {
        $this->initialization();
        $this->locationVehicule = $locationVehicule;
        $this->entreprise_id = $locationVehicule->annonce->entreprise_id;
        $this->nom = $locationVehicule->annonce->titre;
        $this->description = $locationVehicule->annonce->description;
        $this->is_active = $locationVehicule->annonce->is_active;
        $this->date_validite = date('Y-m-d', strtotime($locationVehicule->annonce->date_validite));
        $this->annee = $locationVehicule->annee;
        $this->marque = $locationVehicule->marque;
        $this->modele = $locationVehicule->modele;
        $this->carburant = $locationVehicule->carburant;
        $this->kilometrage = $locationVehicule->kilometrage;
        $this->boite_vitesses = $locationVehicule->boite_vitesse;
        $this->nombre_portes = $locationVehicule->nombre_portes;
        $this->nombre_places = $locationVehicule->nombre_places;

        $this->types_vehicule = $locationVehicule->annonce->references('types-de-voiture')->pluck('id')->toArray();
        $this->equipements_vehicule = $locationVehicule->annonce->references('options-accessoires')->pluck('id')->toArray();
        $this->conditions_location = $locationVehicule->annonce->references('conditions-de-location')->pluck('id')->toArray();

        $this->old_galerie = $locationVehicule->annonce->galerie()->get();
        $this->old_image = $locationVehicule->annonce->imagePrincipale;

        $this->list_marques = Marque::orderBy('nom')->get();
        $this->modele_id = $locationVehicule->modele_id;
        $this->marque_id = $locationVehicule->modele->marque_id;
        $this->list_modeles = Modele::where('marque_id', $this->marque_id)->orderBy('nom')->get();


        $this->pays = Pays::orderBy('nom')->get();
        $this->pays_id = $locationVehicule->annonce->ville->pays_id;
        $this->ville_id = $locationVehicule->annonce->ville_id;
        $this->quartier_id = $locationVehicule->annonce->quartier;
        $this->villes = Ville::where('pays_id', $this->pays_id)->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->get();
        $this->latitude = $locationVehicule->annonce->latitude;
        $this->longitude = $locationVehicule->annonce->longitude;
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

        $tmp_marque = Reference::where('slug_type', 'marque')->where('slug_nom', 'marques-de-vehicule')->first();
        $tmp_marque ?
            $this->list_marques = ReferenceValeur::where('reference_id', $tmp_marque->id)->select('valeur', 'id')->get() :
            $this->list_marques = [];

        $tmp_type_carburant = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'types-moteur')->first();
        $tmp_type_carburant ?
            $this->list_types_carburant = ReferenceValeur::where('reference_id', $tmp_type_carburant->id)->select('valeur', 'id')->get() :
            $this->list_types_carburant = [];
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->locationVehicule->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'required|string|min:3',
            'modele_id' => 'required|integer|exists:modeles,id',
            'annee' => 'nullable|integer|min:1800|max:9999',
            'carburant' => 'nullable|string|exists:reference_valeurs,valeur',
            'kilometrage' => 'nullable|integer|min:0|max:999999',
            'boite_vitesse' => 'nullable|string|exists:reference_valeurs,valeur',
            'nombre_portes' => 'required|integer|min:1|max:20',
            'nombre_places' => 'nullable|integer|min:0|max:100',
            'types_vehicule' => 'nullable|array',
            'types_vehicule.*' => 'nullable|integer|exists:reference_valeurs,id',
            'equipements_vehicule' => 'nullable|array',
            'equipements_vehicule.*' => 'nullable|integer|exists:reference_valeurs,id',
            'conditions_location' => 'nullable|array',
            'conditions_location.*' => 'nullable|integer|exists:reference_valeurs,id',

            'longitude' => 'required|string',
            'latitude' => 'required|string',

            'image' => 'nullable|image|max:5120|mimes:jpeg,png,jpg',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg',
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
            'modele_id.integer' => __('Modèle invalide'),
            'modele_id.exists' => __('Modèle invalide'),

            'annee.integer' => __('Année invalide'),
            'annee.min' => __('L\'année doit être supérieure ou égale à :min'),
            'annee.max' => __('L\'année doit être inférieure ou égale à :max'),

            'carburant.integer' => __('Type de carburant invalide'),
            'carburant.exists' => __('Type de carburant invalide'),

            'kilometrage.integer' => __('Kilométrage invalide'),
            'kilometrage.min' => __('Le kilométrage doit être supérieur ou égal à :min'),
            'kilometrage.max' => __('Le kilométrage doit être inférieur ou égal à :max'),

            'boite_vitesse.integer' => __('Boite de vitesse invalide'),
            'boite_vitesse.exists' => __('Boite de vitesse invalide'),

            'nombre_portes.integer' => __('Nombre de portes invalide'),
            'nombre_portes.min' => __('Le nombre de portes doit être supérieur ou égal à :min'),
            'nombre_portes.max' => __('Le nombre de portes doit être inférieur ou égal à :max'),

            'longitude.required' => __('Veuillez renseigner la longitude'),
            'longitude.string' => __('Longitude invalide'),
            'latitude.required' => __('Veuillez renseigner la latitude'),
            'latitude.string' => __('Latitude invalide'),

            'image.required' => 'L\'image est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.max' => 'Le fichier ne doit pas dépasser :max Mo',
            'image.mimes' => 'Le fichier doit être de type jpeg, png ou jpg',

            'galerie.*.image' => 'Le fichier doit être une image',
            'galerie.*.max' => 'Le fichier ne doit pas dépasser :max Mo',
            'galerie.max' => 'Vous ne pouvez pas charger plus de :max images',
            'galerie.*.mimes' => 'Le fichier doit être de type jpeg, png ou jpg',
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

    public function update()
    {
        $this->validate();

        if ($this->is_active && $this->date_validite < date('Y-m-d')) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('La date de validité doit être supérieure à la date du jour'),
            ]);
            return;
        }

        try {
            DB::beginTransaction();

            $this->locationVehicule->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);


            $this->locationVehicule->update([
                'annee' => $this->annee,
                'carburant' => $this->carburant,
                'kilometrage' => $this->kilometrage,
                'boite_vitesse' => $this->boite_vitesses,
                'nombre_portes' => $this->nombre_portes,
                'nombre_places' => $this->nombre_places,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'modele_id' => $this->modele_id,
            ]);

            $references = [
                ['Types de voiture', $this->types_vehicule],
                ['Options et accessoires', $this->equipements_vehicule],
                ['Conditions de location', $this->conditions_location],
            ];

            AnnoncesUtils::updateManyReference($this->locationVehicule->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->locationVehicule->annonce, $this->galerie, $this->deleted_old_galerie, 'location-vehicules');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de la modification de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', __('L\'annonce a été modifiée avec succès'));
        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.location-vehicule.edit');
    }
}
