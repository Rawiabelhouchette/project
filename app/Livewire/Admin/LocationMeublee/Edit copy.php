<?php

namespace App\Livewire\Admin\LocationMeublee;

use App\Livewire\Admin\AnnonceBaseEdit;
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
    public $types_hebergement;
    public $is_active;
    public $description;
    public $nombre_chambre;
    public $nombre_personne;
    public $nombre_salles_bain;
    public $superficie;
    public $prix_min;
    public $prix_max;
    public $entreprise_id;
    public $entreprises = [];
    public $types_lit = [];
    public $list_types_lit = [];
    public $commodites = [];
    public $list_commodites = [];
    public $services = [];
    public $list_services = [];
    public $equipements_herbegement = [];
    public $list_equipements_herbegement = [];
    public $equipements_salle_bain = [];
    public $list_equipements_salle_bain = [];
    public $equipements_cuisine = [];
    public $list_equipements_cuisine = [];
    public $list_types_hebergement = [];
    public $date_validite;
    public $locationMeublee;
    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public $latitude;
    public $longitude;

    public function mount($locationMeublee)
    {
        $this->initialization();
        $this->locationMeublee = $locationMeublee;
        $this->entreprise_id = $locationMeublee->annonce->entreprise_id;
        $this->nom = $locationMeublee->annonce->titre;
        $this->is_active = $locationMeublee->annonce->is_active;
        $this->description = $locationMeublee->annonce->description;
        $this->nombre_chambre = $locationMeublee->nombre_chambre;
        $this->nombre_personne = $locationMeublee->nombre_personne;
        $this->nombre_salles_bain = $locationMeublee->nombre_salles_bain;
        $this->superficie = $locationMeublee->superficie;
        $this->prix_min = $locationMeublee->prix_min;
        $this->prix_max = $locationMeublee->prix_max;
        $this->date_validite = date('Y-m-d', strtotime($locationMeublee->annonce->date_validite));
        $this->types_lit = $locationMeublee->annonce->references('types-de-lit')->pluck('id')->toArray();
        $this->commodites = $locationMeublee->annonce->references('commodites-hebergement')->pluck('id')->toArray();
        $this->services = $locationMeublee->annonce->references('services-proposes')->pluck('id')->toArray();
        $this->equipements_herbegement = $locationMeublee->annonce->references('equipements-hebergement')->pluck('id')->toArray();
        $this->equipements_salle_bain = $locationMeublee->annonce->references('equipements-salle-de-bain')->pluck('id')->toArray();
        $this->equipements_cuisine = $locationMeublee->annonce->references('accessoires-de-cuisine')->pluck('id')->toArray();
        $this->types_hebergement = $locationMeublee->annonce->references('types-hebergement')->pluck('id')->toArray();
        $this->old_galerie = $locationMeublee->annonce->galerie()->get();
        $this->old_image = $locationMeublee->annonce->imagePrincipale;


        $this->pays_id = $locationMeublee->annonce->ville->pays_id;
        $this->ville_id = $locationMeublee->annonce->ville_id;
        $this->quartier_id = $locationMeublee->annonce->quartier;
        $this->villes = Ville::where('pays_id', $this->pays_id)->orderBy('nom')->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->orderBy('nom')->get();
        $this->latitude = $locationMeublee->annonce->latitude;
        $this->longitude = $locationMeublee->annonce->longitude;
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_commodite = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'commodites-hebergement')->first();
        $tmp_commodite ?
            $this->list_commodites = ReferenceValeur::where('reference_id', $tmp_commodite->id)->select('valeur', 'id')->get() :
            $this->list_commodites = [];

        $tmp_types_lit = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'types-de-lit')->first();
        $tmp_types_lit ?
            $this->list_types_lit = ReferenceValeur::where('reference_id', $tmp_types_lit->id)->select('valeur', 'id')->get() :
            $this->list_types_lit = [];

        $tmp_services = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'services-proposes')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $tmp_equipements_herbegement = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-hebergement')->first();
        $tmp_equipements_herbegement ?
            $this->list_equipements_herbegement = ReferenceValeur::where('reference_id', $tmp_equipements_herbegement->id)->select('valeur', 'id')->get() :
            $this->list_equipements_herbegement = [];

        $tmp_equipements_salle_bain = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-salle-de-bain')->first();
        $tmp_equipements_salle_bain ?
            $this->list_equipements_salle_bain = ReferenceValeur::where('reference_id', $tmp_equipements_salle_bain->id)->select('valeur', 'id')->get() :
            $this->list_equipements_salle_bain = [];

        $tmp_equipements_cuisine = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'accessoires-de-cuisine')->first();
        $tmp_equipements_cuisine ?
            $this->list_equipements_cuisine = ReferenceValeur::where('reference_id', $tmp_equipements_cuisine->id)->select('valeur', 'id')->get() :
            $this->list_equipements_cuisine = [];

        $tmp_types_hebergement = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'types-hebergement')->first();
        $tmp_types_hebergement ?
            $this->list_types_hebergement = ReferenceValeur::where('reference_id', $tmp_types_hebergement->id)->select('valeur', 'id')->get() :
            $this->list_types_hebergement = [];

        $this->pays = Pays::orderBy('nom')->get();
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->locationMeublee->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,

            // 'entreprise_id' => 'required|exists:entreprises,id',
            // // 'nom' => 'required|string|min:3|unique:annonces,titre,id,entreprise_id', update
            // 'nom' => 'required|string|min:3|unique:annonces,titre'. $this->annonce->id .',id,entreprise_id'. $this->entreprise_id,
            'type' => 'nullable',
            'is_active' => 'required|boolean',
            'description' => 'nullable|min:3',
            'nombre_chambre' => 'required|numeric',
            'nombre_personne' => 'nullable|numeric',
            'superficie' => 'nullable|numeric',
            'types_lit' => 'required',
            'commodites' => 'nullable',
            'services' => 'nullable',
            'equipements_herbegement' => 'nullable',
            'equipements_salle_bain' => 'nullable',
            'equipements_cuisine' => 'required',
            // 'galerie.*' => 'image|max:5120',
            // 'galerie' => 'max:10',
            'date_validite' => 'required|date',
            // 'heure_validite' => 'required|date_format:H:i',
            // prix_min < prix_max
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Ce champ est obligatoire'),
            'entreprise_id.exists' => __('Cette entreprise n\'existe pas'),
            'nom.required' => __('Ce champ est obligatoire'),
            'nom.string' => __('Ce champ doit être une chaîne de caractères'),
            'nom.min' => __('Ce champ doit contenir au moins :min caractères'),
            'nom.max' => __('Ce champ doit contenir au plus :max caractères'),
            'nom.unique' => __('Ce nom est déjà utilisé'),
            'type.string' => __('Ce champ doit être une chaîne de caractères'),
            'type.min' => __('Ce champ doit contenir au moins :min caractères'),
            'type.max' => __('Ce champ doit contenir au plus :max caractères'),
            'is_active.required' => __('Ce champ est obligatoire'),
            'is_active.boolean' => __('Ce champ doit être un booléen'),
            'description.string' => __('Ce champ doit être une chaîne de caractères'),
            'description.min' => __('Ce champ doit contenir au moins :min caractères'),
            'description.max' => __('Ce champ doit contenir au plus :max caractères'),
            'nombre_chambre.required' => __('Ce champ est obligatoire'),
            'nombre_chambre.numeric' => __('Ce champ doit être un nombre'),
            'nombre_personne.numeric' => __('Ce champ doit être un nombre'),
            'superficie.numeric' => __('Ce champ doit être un nombre'),
            'types_lit.required' => __('Ce champ est obligatoire'),
            'commodites.required' => __('Ce champ est obligatoire'),
            'services.required' => __('Ce champ est obligatoire'),
            'equipements_herbegement.required' => __('Ce champ est obligatoire'),
            'equipements_salle_bain.required' => __('Ce champ est obligatoire'),
            'equipements_cuisine.required' => __('Ce champ est obligatoire'),
            'prix_min.numeric' => __('Ce champ doit être un nombre'),
            'prix_max.numeric' => __('Ce champ doit être un nombre'),
            'prix_min.lt' => __('Ce champ doit être inférieur à :prix_max'),
            'prix_max.lt' => __('Ce champ doit être supérieur à :prix_min'),
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

            $this->locationMeublee->annonce->update([
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


            $this->locationMeublee->update([
                'nombre_chambre' => $this->nombre_chambre,
                'nombre_personne' => $this->nombre_personne,
                'superficie' => $this->superficie,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
                'nombre_salles_bain' => $this->nombre_salles_bain,
            ]);

            $references = [
                ['Types de lit', $this->types_lit],
                ['Commodités hébergement', $this->commodites],
                ['Services proposés', $this->services],
                ['Equipements hébergement', $this->equipements_herbegement],
                ['Equipements salle de bain', $this->equipements_salle_bain],
                ['Accessoires de cuisine', $this->equipements_cuisine],
                ['Types hébergement', $this->types_hebergement],
            ];

            AnnoncesUtils::updateManyReference($this->locationMeublee->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->locationMeublee->annonce, $this->galerie, $this->deleted_old_galerie, 'location-meublees');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'LocationMeublee'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', 'L\'annonce a bien été modifiée.');
        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.location-meublee.edit');
    }
}
