<?php

namespace App\Livewire\Admin\Auberge;

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

    public $auberge;
    public $is_active;
    public $nom;
    public $type;
    public $types_hebergement;
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
    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public $latitude;
    public $longitude;

    public function mount($auberge)
    {
        $this->initialization();
        $this->auberge = $auberge;
        $this->entreprise_id = $auberge->annonce->entreprise_id;
        $this->nom = $auberge->annonce->titre;
        $this->is_active = $auberge->annonce->is_active;
        $this->description = $auberge->annonce->description;
        $this->nombre_chambre = $auberge->nombre_chambre;
        $this->nombre_personne = $auberge->nombre_personne;
        $this->nombre_salles_bain = $auberge->nombre_salles_bain;
        $this->superficie = $auberge->superficie;
        $this->prix_min = $auberge->prix_min;
        $this->prix_max = $auberge->prix_max;
        $this->date_validite = date('Y-m-d', strtotime($auberge->annonce->date_validite));
        $this->types_lit = $auberge->annonce->references('types-de-lit')->pluck('id')->toArray();
        $this->commodites = $auberge->annonce->references('commodites-hebergement')->pluck('id')->toArray();
        $this->services = $auberge->annonce->references('services')->pluck('id')->toArray();
        $this->equipements_herbegement = $auberge->annonce->references('equipements-hebergement')->pluck('id')->toArray();
        $this->equipements_salle_bain = $auberge->annonce->references('equipements-salle-de-bain')->pluck('id')->toArray();
        $this->equipements_cuisine = $auberge->annonce->references('accessoires-de-cuisine')->pluck('id')->toArray();
        $this->types_hebergement = $auberge->annonce->references('types-hebergement')->pluck('id')->toArray();
        $this->old_galerie = $auberge->annonce->galerie()->get();
        $this->old_image = $auberge->annonce->imagePrincipale;


        $this->pays_id = $auberge->annonce->ville->pays_id;
        $this->ville_id = $auberge->annonce->ville_id;
        $this->quartier_id = $auberge->annonce->quartier;
        $this->villes = Ville::where('pays_id', $this->pays_id)->orderBy('nom')->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->orderBy('nom')->get();
        $this->latitude = $auberge->annonce->latitude;
        $this->longitude = $auberge->annonce->longitude;
    }

    public function updatedSelectedImages($images)
    {
        foreach ($images as $image) {
            $this->galerie[] = $image;
        }

        $this->selected_images = [];
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
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->auberge->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'type' => 'nullable',
            'is_active' => 'required|boolean',
            'description' => 'nullable|min:3',
            'nombre_chambre' => 'nullable|numeric',
            'nombre_personne' => 'nullable|numeric',
            'superficie' => 'nullable|numeric',
            'types_lit' => 'nullable',
            'commodites' => 'nullable',
            'services' => 'nullable',
            'equipements_herbegement' => 'nullable',
            'equipements_salle_bain' => 'nullable',
            'equipements_cuisine' => 'nullable',

            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',

            'longitude' => 'required',
            'latitude' => 'required',

            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required',

            'image' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,heic',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg,heic',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'nom.unique' => 'Le nom est déjà pris',
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.exists' => 'L\'entreprise n\'existe pas',

            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.lt' => 'Le prix maximum doit être supérieur au prix minimum',

            'longitude.required' => 'La longitude est obligatoire',
            'latitude.required' => 'La latitude est obligatoire',

            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville n\'existe pas',
            'quartier_id.required' => 'Le quartier est obligatoire',

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

    public function update()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->auberge->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            $this->auberge->update([
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

            AnnoncesUtils::updateManyReference($this->auberge->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->auberge->annonce, $this->galerie, $this->deleted_old_galerie, 'auberges');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Une erreur est survenue lors de la modification de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        //! CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', 'L\'annonce a bien été modifiée.');
        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.auberge.edit');
    }
}
