<?php

namespace App\Livewire\Admin\Bar;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\Bar;
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

    public $type_bar;

    public $capacite_accueil;

    public $prix_min;

    public $prix_max;

    public $equipements_vie_nocturne = [];

    public $list_equipements_vie_nocturne = [];

    public $commodites_vie_nocturne = [];

    public $list_commodites_vie_nocturne = [];

    public $types_musique = [];

    public $list_types_musique = [];

    public $entreprises = [];

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

        $tmp_types_musique = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'types-de-musique')->first();
        $tmp_types_musique ?
            $this->list_types_musique = ReferenceValeur::where('reference_id', $tmp_types_musique->id)->select('valeur', 'id')->get() :
            $this->list_types_musique = [];

        $tmp_equipement_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'equipements-vie-nocturne')->first();
        $tmp_equipement_vie_nocturne ?
            $this->list_equipements_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_equipement_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vie_nocturne = [];

        $tmp_commodite_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'commodites-vie-nocturne')->first();
        $tmp_commodite_vie_nocturne ?
            $this->list_commodites_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_commodite_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_commodites_vie_nocturne = [];

        $this->pays = Pays::orderBy('nom')->get();

        $this->date_validite = auth()->user()->activeAbonnements()->date_fin->format('Y-m-d');
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'type_bar' => 'nullable|string',

            'capacite_accueil' => 'nullable|integer',
            'equipements_vie_nocturne' => 'nullable|array',
            'equipements_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'commodites_vie_nocturne' => 'nullable|array',
            'commodites_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'types_musique' => 'nullable|array',
            'types_musique.*' => 'nullable|integer|exists:reference_valeurs,id',

            'image' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,heic',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg,heic|uploaded',

            'prix_min' => 'required|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
            // // 'image' => 'required',
            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required|string|max:255',

            'longitude' => 'required|string',
            'latitude' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',

            'description.string' => 'La description doit être une chaîne de caractères',
            'description.min' => 'La description doit contenir au moins 3 caractères',

            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.integer' => 'L\'entreprise doit être un entier',
            'entreprise_id.exists' => 'L\'entreprise n\'existe pas',

            'type_bar.string' => 'Le type de bar doit être une chaîne de caractères',

            'types_musique.integer' => 'Le type de musique doit être un entier',
            'types_musique.exists' => 'Le type de musique n\'existe pas',

            'capacite_accueil.integer' => 'La capacité d\'accueil doit être un entier',

            'equipements_vie_nocturne.required' => 'Les équipements de vie nocturne sont obligatoires',
            'equipements_vie_nocturne.array' => 'Les équipements de vie nocturne doivent être un tableau',
            'equipements_vie_nocturne.*.required' => 'Un équipement de vie nocturne est obligatoire',
            'equipements_vie_nocturne.*.integer' => 'Un équipement de vie nocturne doit être un entier',
            'equipements_vie_nocturne.*.exists' => 'Un équipement de vie nocturne n\'existe pas',

            'commodites_vie_nocturne.required' => 'Les commodités de vie nocturne sont obligatoires',
            'commodites_vie_nocturne.array' => 'Les commodités de vie nocturne doivent être un tableau',
            'commodites_vie_nocturne.*.required' => 'Une commodité de vie nocturne est obligatoire',
            'commodites_vie_nocturne.*.integer' => 'Une commodité de vie nocturne doit être un entier',
            'commodites_vie_nocturne.*.exists' => 'Une commodité de vie nocturne n\'existe pas',

            'image.required' => 'L\'image est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.uploaded' => 'Le fichier ne s\'est pas chargé',
            'image.max' => 'Le fichier ne doit pas dépasser :max Mo',
            'image.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou heic',

            'galerie.*.image' => 'Le fichier doit être une image',
            'galerie.*.max' => 'Le fichier ne doit pas dépasser 5 Mo',
            'galerie.max' => 'Vous ne pouvez pas charger plus de :max images',
            'galerie.*.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou heic',

            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_min.required' => 'Le prix minimum est obligatoire',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',

            // validation.uploaded
            'image.uploaded' => 'L\'image doit être une image',

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

            $bar = Bar::create([
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
                'capacite_accueil' => $this->capacite_accueil,
                'type_bar' => $this->type_bar,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Bar',
                'description' => $this->description,
                'entreprise_id' => $this->entreprise_id,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,

                'longitude' => $this->longitude,
                'latitude' => $this->latitude,

                'prix' => $this->prix_min,
            ]);

            $bar->annonce()->save($annonce);

            $references = [
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités de vie nocturne', $this->commodites_vie_nocturne],
                ['Types de musique', [$this->types_musique]],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'bars');

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

        session()->flash('success', 'L\'annonce a bien été ajoutée');

        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.bar.create');
    }
}
