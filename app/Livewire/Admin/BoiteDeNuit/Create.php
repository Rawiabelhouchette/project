<?php

namespace App\Livewire\Admin\BoiteDeNuit;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\BoiteDeNuit;
use App\Models\Entreprise;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Ville;
use App\Traits\CustomValidation;
use App\Utils\AnnoncesUtils;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AnnonceBaseCreate, CustomValidation, WithFileUploads;

    public $nom;

    public $type;

    public $description;

    public $date_validite;

    public $entreprise_id;

    public $entreprises;

    public $commodites = [];

    public $list_commodites = [];

    public $services = [];

    public $list_services = [];

    public $types_musique = [];

    public $list_types_musique = [];

    public $equipements_vie_nocturne = [];

    public $list_equipements_vie_nocturne = [];

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
        $this->entreprises = \Auth::user()->entreprises;
        $this->entreprise_id = $this->entreprises->first()->id;

        $tmp_commodite = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'commodites-hebergement')->first();
        $tmp_commodite ?
            $this->list_commodites = ReferenceValeur::where('reference_id', $tmp_commodite->id)->select('valeur', 'id')->get() :
            $this->list_commodites = [];

        $tmp_services = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'services-proposes')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $tmp_types_musique = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'types-de-musique')->first();
        $tmp_types_musique ?
            $this->list_types_musique = ReferenceValeur::where('reference_id', $tmp_types_musique->id)->select('valeur', 'id')->get() :
            $this->list_types_musique = [];

        $tmp_equipements_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'equipements-vie-nocturne')->first();
        $tmp_equipements_vie_nocturne ?
            $this->list_equipements_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_equipements_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vie_nocturne = [];

        $this->pays = Pays::orderBy('nom')->get();

        $this->date_validite = auth()->user()->activeAbonnements()->date_fin->format('Y-m-d');
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3',
            'type' => 'nullable',
            'description' => 'nullable|min:3',
            'commodites' => 'nullable',
            'services' => 'nullable',

            'types_musique' => 'nullable',
            'equipements_vie_nocturne' => 'nullable',

            'longitude' => 'required|string',
            'latitude' => 'required|string',

            'image' => 'required|image|max:5120|mimes:jpeg,png,jpg,heic',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg,heic',

            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.exists' => 'L\'entreprise est invalide',
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins :min caractères',
            'nom.max' => 'Le nom doit contenir au plus :max caractères',
            'nom.unique' => 'Le nom existe déjà',
            'type.string' => 'Le type doit être une chaîne de caractères',
            'type.min' => 'Le type doit contenir au moins :min caractères',
            'type.max' => 'Le type doit contenir au plus :max caractères',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.min' => 'La description doit contenir au moins :min caractères',
            'description.max' => 'La description doit contenir au plus :max caractères',
            'commodites.array' => 'Les commodités doivent être un tableau',
            'services.array' => 'Les services doivent être un tableau',
            // 'galerie.*.max' => 'Les images doivent être de taille inférieure à 5Mo',
            'types_musique.array' => 'Les types de musique doivent être un tableau',
            'equipements_vie_nocturne.array' => 'Les équipements de vie nocturne doivent être un tableau',

            'image.required' => 'L\'image est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.max' => 'Le fichier ne doit pas dépasser :max Mo',
            'image.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou heic',

            'galerie.*.image' => 'Le fichier doit être une image',
            'galerie.*.max' => 'Le fichier ne doit pas dépasser 5 Mo',
            'galerie.max' => 'Vous ne pouvez pas charger plus de :max images',
            'galerie.*.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou heic',

            'pays_id.required' => 'Le pays est obligatoire',
            'pays_id.exists' => 'Le pays n\'existe pas',
            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville n\'existe pas',
            'quartier_id.required' => 'Le quartier est obligatoire',

            'longitude.required' => 'La localisation est obligatoire.',
        ];
    }

    #[On('setLocation')]
    public function setLocation($location)
    {
        $this->longitude = (string) $location['lon'];
        $this->latitude = (string) $location['lat'];
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

    public function store()
    {
        if (!$this->validateWithCustom()) {
            return;
        }

        try {
            DB::beginTransaction();

            $boiteDeNuit = BoiteDeNuit::create([]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Boite de nuit',
                'description' => $this->description,
                'entreprise_id' => $this->entreprise_id,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,

                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            $boiteDeNuit->annonce()->save($annonce);

            $references = [
                ['Types de musique', $this->types_musique],
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités hébergement', $this->commodites],
                ['Services proposés', $this->services],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'boite-de-nuits');

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

        // ! CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', 'L\'annonce a bien été ajoutée');

        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.boite-de-nuit.create');
    }
}
