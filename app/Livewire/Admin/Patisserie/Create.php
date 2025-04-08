<?php

namespace App\Livewire\Admin\Patisserie;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\Patisserie;
use App\Models\Entreprise;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Ville;
use App\Utils\AnnoncesUtils;
use App\Utils\Utils;
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
    public $date_validite;
    public $entreprise_id;
    public $accompagnement;

    public $services = [];
    public $list_services = [];

    public $produits_fast_food = [];
    public $list_produits_fast_food = [];

    public $equipements_restauration = [];
    public $list_equipements_restauration = [];

    public $entreprises = [];

    public $nom_produit;
    public $prix_produit;
    public $image_produit;
    public $accompagnements_produit;

    public $produits = [
        [
            'nom' => '',
            'prix' => '',
            'image' => '',
            'accompagnements' => '',
        ]
    ];

    public $produits_error = '';

    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public $latitude;
    public $longitude;

    public $galerie = [];
    public $old_galerie = [];

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

        $tmp_produit_fast_food = Reference::where('slug_type', 'restauration')->where('slug_nom', 'produits-patisserie')->first();
        $tmp_produit_fast_food ?
            $this->list_produits_fast_food = ReferenceValeur::where('reference_id', $tmp_produit_fast_food->id)->select('valeur', 'id')->get() :
            $this->list_produits_fast_food = [];

        $tmp_equipement_restauration = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-restauration')->first();
        $tmp_equipement_restauration ?
            $this->list_equipements_restauration = ReferenceValeur::where('reference_id', $tmp_equipement_restauration->id)->select('valeur', 'id')->get() :
            $this->list_equipements_restauration = [];

        $tmp_services = Reference::where('slug_type', 'restauration')->where('slug_nom', 'services-proposes')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $this->pays = Pays::orderBy('nom')->get();

    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|max:255|unique:annonces,titre,id,entreprise_id',
            'description' => 'nullable|min:3|max:255',


            'produits' => 'required|array|min:1',

            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required|string|max:255',

            'longitude' => 'required|string',
            'latitude' => 'required|string',

            'image' => 'required|image|max:5120|mimes:jpeg,png,jpg',
            'galerie' => 'array|max:6',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => 'Le champ entreprise est obligatoire.',
            'entreprise_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le champ nom doit être une chaîne de caractères.',
            'nom.min' => 'Le champ nom doit contenir au moins 3 caractères.',
            'nom.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
            'nom.unique' => 'Le nom de l\'annonce existe déjà.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.min' => 'Le champ description doit contenir au moins 3 caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser 255 caractères.',
            'date_validite.required' => 'Le champ date de validité est obligatoire.',
            'date_validite.date' => 'Le champ date de validité doit être une date.',
            'date_validite.after' => 'Le champ date de validité doit être une date supérieure à la date du jour.',

            'pays_id.required' => 'Le pays est obligatoire',
            'pays_id.exists' => 'Le pays n\'existe pas',
            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville n\'existe pas',
            'quartier_id.required' => 'Le quartier est obligatoire',

            'longitude.required' => 'La localisation est obligatoire.',

            'produits.required' => 'Le champ produits est obligatoire.',
            'produits.array' => 'Le champ produits doit être un tableau.',
            'produits.min' => 'Le champ produits doit contenir au moins un élément.',

            'image.required' => 'L\'image est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.max' => 'Le fichier ne doit pas dépasser :max Mo',
            'image.mimes' => 'Le fichier doit être de type jpeg, png ou jpg',

            'galerie.*.image' => 'Le fichier doit être une image',
            'galerie.*.max' => 'Le fichier ne doit pas dépasser 5 Mo',
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

    public function addProduit()
    {
        $result = $this->checkUniqueProduit();
        if (!$result) {
            return;
        }

        $this->produits_error = '';

        $this->produits[] = [
            'nom' => '',
            'prix' => '',
            'image' => '',
            'accompagnements' => '',
        ];
    }

    private function checkUniqueProduit(): bool
    {
        $length = count($this->produits);
        if ($length != 0) {
            $i = $length - 1;
            if (empty($this->produits[$i]['nom']) || empty($this->produits[$i]['prix']) || empty($this->produits[$i]['image']) || empty($this->produits[$i]['accompagnements'])) {
                $this->produits_error = 'Veuillez remplir tous les champs';
                return false;
            }

            foreach ($this->produits as $key => $produit) {
                if ($key == $i)
                    continue;
                if ($produit['nom'] == $this->produits[$i]['nom']) {
                    $this->produits_error = 'Ce nom de produit existe déjà';
                    return false;
                }
            }
        }

        return true;
    }

    public function removeProduit($key)
    {
        unset($this->produits[$key]);
        $this->produits = array_values($this->produits);
        $this->produits_error = '';
    }

    public function store()
    {
        $this->validate();

        $separator = Utils::getRestaurantValueSeparator();
        $separator2 = Utils::getRestaurantImageSeparator();
        $quartier = $this->quartier_id;

        // Put all produits in the same variable
        foreach ($this->produits as $produit) {
            $this->nom_produit .= $produit['nom'] . $separator;
            $this->prix_produit .= $produit['prix'] . $separator;
            $this->accompagnements_produit .= $produit['accompagnements'] . $separator;

            // upload image
            $uploadResult = AnnoncesUtils::storeImage($produit['image'], 'patisseries');
            $this->image_produit .= "{$uploadResult->id}{$separator2}";
        }

        try {
            DB::beginTransaction();

            $patisserie = Patisserie::create([
                'nom_produit' => $this->nom_produit,
                'accompagnement_produit' => $this->accompagnements_produit,
                'prix_produit' => $this->prix_produit,
                'image_produit' => $this->image_produit,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Patisserie',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'ville_id' => $this->ville_id,
                'quartier' => $quartier,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            $patisserie->annonce()->save($annonce);

            $references = [
                ['Equipements restauration', $this->equipements_restauration],
                ['Services', $this->services],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'patisseries');

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
        return view('livewire.admin.patisserie.create');
    }
}
