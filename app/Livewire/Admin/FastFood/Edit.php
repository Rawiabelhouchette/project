<?php

namespace App\Livewire\Admin\FastFood;

use App\Livewire\Admin\AnnonceBaseEdit;
use App\Models\Annonce;
use App\Models\FastFood;
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

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $fastFood;
    public $is_active;
    public $nom;
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;
    public $accompagnement;

    public $prix_min;
    public $prix_max;

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

    public $image;

    public $galerie = [];
    public $old_galerie = [];

    public function mount($fastFood)
    {
        $this->initialization();
        $this->fastFood = $fastFood;
        $this->entreprise_id = $fastFood->annonce->entreprise_id;
        $this->nom = $fastFood->annonce->titre;
        $this->description = $fastFood->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($fastFood->annonce->date_validite));
        $this->old_galerie = $fastFood->annonce->galerie()->get();
        $this->old_image = $fastFood->annonce->imagePrincipale;
        $this->is_active = $fastFood->annonce->is_active;
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_produit_fast_food = Reference::where('slug_type', 'restauration')->where('slug_nom', 'produits-fast-food')->first();
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

        $this->pays = Pays::all();

    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|max:255|unique:annonces,titre,id,entreprise_id',
            'description' => 'nullable|min:3|max:255',
            'date_validite' => 'required|date|after:today',
            // 'accompagnement' => 'nullable|string|min:3|max:255',
            // 'prix_min' => 'nullable|numeric|lt:prix_max',
            // 'prix_max' => 'nullable|numeric',

            'produits' => 'required|array|min:1',

            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'nullable|exists:quartiers,id',

            'longitude' => 'required|string',
            'latitude' => 'required|string',
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
            // 'accompagnement.string' => 'Le champ ingrédient doit être une chaîne de caractères.',
            // 'accompagnement.min' => 'Le champ ingrédient doit contenir au moins 3 caractères.',
            // 'accompagnement.max' => 'Le champ ingrédient ne doit pas dépasser 255 caractères.',
            // 'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            // 'prix_max.numeric' => 'Le prix maximum doit être un nombre',
            // 'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            // 'prix_max.lt' => 'Le prix maximum doit être supérieur au prix minimum',
            'pays_id.required' => 'Le pays est obligatoire',
            'pays_id.exists' => 'Le pays n\'existe pas',
            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville n\'existe pas',
            'quartier_id.exists' => 'Le quartier n\'existe pas',

            'longitude.required' => 'La localisation est obligatoire.',

            'produits.required' => 'Le champ produits est obligatoire.',
            'produits.array' => 'Le champ produits doit être un tableau.',
            'produits.min' => 'Le champ produits doit contenir au moins un élément.',


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
        $this->villes = Ville::where('pays_id', $pays_id)->get();
    }

    public function updatedVilleId($ville_id)
    {
        $this->quartier_id = null;
        $this->quartiers = Quartier::where('ville_id', $ville_id)->get();
    }

    public function addProduit()
    {
        // dd($this->produits);
        $length = count($this->produits);
        if ($length != 0) {
            $i = $length - 1;
            if (empty($this->produits[$i]['nom']) || empty($this->produits[$i]['prix']) || empty($this->produits[$i]['image']) || empty($this->produits[$i]['accompagnements'])) {
                return;
            }

            foreach ($this->produits as $key => $produit) {
                if ($key == $i)
                    continue;
                if ($produit['nom'] == $this->produits[$i]['nom']) {
                    $this->produits_error = 'Ce nom de produit existe déjà';
                    return;
                }
            }
        }

        $this->produits_error = '';

        $this->produits[] = [
            'nom' => '',
            'prix' => '',
            'image' => '',
            'accompagnements' => '',
        ];
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

        // Put all produits in the same variable
        foreach ($this->produits as $produit) {
            $this->nom_produit .= $produit['nom'] . $separator;
            $this->prix_produit .= $produit['prix'] . $separator;
            $this->accompagnements_produit .= $produit['accompagnements'] . $separator;

            // upload image
            $uploadResult = AnnoncesUtils::storeImage($produit['image'], 'fast-foods');
            $this->image_produit .= "{$uploadResult->id}{$separator2}";
        }

        // Handle the new image property
        if ($this->image) {
            $uploadResult = AnnoncesUtils::storeImage($this->image, 'fast-foods');
            $this->image_produit .= "{$uploadResult->id}{$separator2}";
        }

        try {
            DB::beginTransaction();

            $fastFood = FastFood::create([
                'nom_produit' => $this->nom_produit,
                'accompagnement_produit' => $this->accompagnements_produit,
                'prix_produit' => $this->prix_produit,
                'image_produit' => $this->image_produit,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Fast-Food',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'ville_id' => $this->ville_id,
                'quartier_id' => $this->quartier_id,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            $fastFood->annonce()->save($annonce);

            $references = [
                ['Equipements restauration', $this->equipements_restauration],
                ['Services', $this->services],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'fast-foods');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
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
        return view('livewire.admin.fast-food.create');
    }
}
