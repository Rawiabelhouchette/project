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
use Livewire\Attributes\On;
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

    public $e_nom;
    public $e_ingredients;
    public $e_prix_min = 0;
    public $e_prix_max = 0;
    public $e_image;

    public $p_nom;
    public $p_ingredients;
    public $p_accompagnements;
    public $p_prix_min = 0;
    public $p_prix_max = 0;
    public $p_image;

    public $d_nom;
    public $d_ingredients;
    public $d_prix_min = 0;
    public $d_prix_max = 0;
    public $d_image;


    public $entrees_error = '';
    public $entrees = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ],
    ];
    public $entrees_count = 1;

    public $plats_error = '';
    public $plats = [
        [
            'nom' => '',
            'ingredients' => '',
            'accompagnements' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ],
    ];
    public $plats_count = 1;

    public $desserts_error = '';
    public $desserts = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ],
    ];
    public $desserts_count = 1;


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

        $tmp_equipement_restauration = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-restauration')->first();
        $tmp_equipement_restauration ?
            $this->list_equipements_restauration = ReferenceValeur::where('reference_id', $tmp_equipement_restauration->id)->select('valeur', 'id')->get() :
            $this->list_equipements_restauration = [];

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

        $this->pays = Pays::orderBy('nom')->get();

    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            // 'e_nom' => 'required|string|min:3',
            // 'e_ingredients' => 'nullable|string|min:3',
            // 'e_prix_min' => 'nullable|integer|min:0|lte:e_prix_max',
            // 'e_prix_max' => 'nullable|integer|min:0',
            // 'p_nom' => 'required|string|min:3',
            // 'p_ingredients' => 'nullable|string|min:3',
            // 'p_prix_min' => 'nullable|integer|min:0|lte:p_prix_max',
            // 'p_prix_max' => 'nullable|integer|min:0',
            // 'd_nom' => 'required|string|min:3',
            // 'd_ingredients' => 'nullable|string|min:3',
            // 'd_prix_min' => 'nullable|integer|min:0|lte:d_prix_max',
            // 'd_prix_max' => 'nullable|integer|min:0',
            // 'equipements_restauration' => 'nullable|array',
            // 'equipements_restauration.*' => 'nullable|integer|exists:reference_valeurs,id',
            // 'specialites' => 'nullable|array',
            // 'specialites.*' => 'nullable|integer|exists:reference_valeurs,id',
            // 'carte_consommation' => 'nullable|array',
            // 'carte_consommation.*' => 'nullable|integer|exists:reference_valeurs,id',

            'entrees' => 'required|array|min:1',
            // 'entrees.*.nom' => 'required|string|min:3',
            // 'entrees.*.ingredients' => 'nullable|string|min:3',
            // 'entrees.*.prix_min' => 'required|integer|min:0',
            // 'entrees.*.prix_max' => 'required|integer|min:0',
            // 'entrees.*.image' => 'required|image',


            'services' => 'nullable',
            'image' => 'required|image',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image',

            'longitude' => 'required|string',
            'latitude' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.min' => 'Le nom doit contenir au moins :min caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.min' => 'La description doit contenir au moins :min caractères.',
            'date_validite.required' => 'La date de validité est obligatoire.',
            'date_validite.date' => 'La date de validité doit être une date.',
            'entreprise_id.required' => 'L\'entreprise est obligatoire.',
            'entreprise_id.integer' => 'L\'entreprise doit être un entier.',
            'entreprise_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'e_nom.required' => 'Le nom de l\'entrée est obligatoire.',
            'e_nom.string' => 'Le nom de l\'entrée doit être une chaîne de caractères.',
            'e_nom.min' => 'Le nom de l\'entrée doit contenir au moins :min caractères.',
            'e_ingredients.string' => 'Les ingrédients de l\'entrée doivent être une chaîne de caractères.',
            'e_ingredients.min' => 'Les ingrédients de l\'entrée doivent contenir au moins :min caractères.',
            'e_prix_min.integer' => 'Le prix minimum de l\'entrée doit être un entier.',
            'e_prix_min.min' => 'Le prix minimum de l\'entrée doit être au moins :min.',
            'e_prix_min.lte' => 'Le prix minimum de l\'entrée doit être inférieur ou égal au prix maximum.',
            'e_prix_max.integer' => 'Le prix maximum de l\'entrée doit être un entier.',
            'e_prix_max.min' => 'Le prix maximum de l\'entrée doit être au moins :min.',
            'p_nom.required' => 'Le nom du plat est obligatoire.',
            'p_nom.string' => 'Le nom du plat doit être une chaîne de caractères.',
            'p_nom.min' => 'Le nom du plat doit contenir au moins :min caractères.',
            'p_ingredients.string' => 'Les ingrédients du plat doivent être une chaîne de caractères.',
            'p_ingredients.min' => 'Les ingrédients du plat doivent contenir au moins :min caractères.',
            'p_prix_min.integer' => 'Le prix minimum du plat doit être un entier.',
            'p_prix_min.min' => 'Le prix minimum du plat doit être au moins :min.',
            'p_prix_min.lte' => 'Le prix minimum du plat doit être inférieur ou égal au prix maximum.',
            'p_prix_max.integer' => 'Le prix maximum du plat doit être un entier.',
            'p_prix_max.min' => 'Le prix maximum du plat doit être au moins :min.',
            'd_nom.required' => 'Le nom du dessert est obligatoire.',
            'd_nom.string' => 'Le nom du dessert doit être une chaîne de caractères.',
            'd_nom.min' => 'Le nom du dessert doit contenir au moins :min caractères.',
            'd_ingredients.string' => 'Les ingrédients du dessert doivent être une chaîne de caractères.',
            'd_ingredients.min' => 'Les ingrédients du dessert doivent contenir au moins :min caractères.',
            'd_prix_min.integer' => 'Le prix minimum du dessert doit être un entier.',
            'd_prix_min.min' => 'Le prix minimum du dessert doit être au moins :min.',
            'd_prix_min.lte' => 'Le prix minimum du dessert doit être inférieur ou égal au prix maximum.',
            'd_prix_max.integer' => 'Le prix maximum du dessert doit être un entier.',
            'd_prix_max.min' => 'Le prix maximum du dessert doit être au moins :min.',
            'equipements_restauration.array' => 'Les équipements de restauration doivent être un tableau.',
            'equipements_restauration.*.integer' => 'Les équipements de restauration doivent être des entiers.',
            'equipements_restauration.*.exists' => 'Les équipements de restauration sélectionnés sont invalides.',
            'specialites.array' => 'Les spécialités doivent être un tableau.',
            'specialites.*.integer' => 'Les spécialités doivent être des entiers.',
            'specialites.*.exists' => 'Les spécialités sélectionnées sont invalides.',
            'carte_consommation.array' => 'La carte de consommation doit être un tableau.',
            'carte_consommation.*.integer' => 'La carte de consommation doit être des entiers.',
            'carte_consommation.*.exists' => 'La carte de consommation sélectionnée est invalide.',
            'galerie.array' => 'La galerie doit être un tableau.',
            'galerie.*.image' => 'La galerie doit contenir des images.',

            'entrees.required' => 'Les entrées sont obligatoires.',
            'entrees.array' => 'Les entrées doivent être un tableau.',
            'entrees.min' => 'Les entrées doivent contenir au moins une entrée.',
            'entrees.*.nom.required' => 'Le nom de l\'entrée est obligatoire.',
            'entrees.*.nom.string' => 'Le nom de l\'entrée doit être une chaîne de caractères.',
            'entrees.*.nom.min' => 'Le nom de l\'entrée doit contenir au moins :min caractères.',
            'entrees.*.ingredients.string' => 'Les ingrédients de l\'entrée doivent être une chaîne de caractères.',
            'entrees.*.ingredients.min' => 'Les ingrédients de l\'entrée doivent contenir au moins :min caractères.',
            'entrees.*.prix_min.required' => 'Le prix minimum de l\'entrée est obligatoire.',
            'entrees.*.prix_min.integer' => 'Le prix minimum de l\'entrée doit être un entier.',
            'entrees.*.prix_min.min' => 'Le prix minimum de l\'entrée doit être au moins :min.',
            'entrees.*.prix_max.required' => 'Le prix maximum de l\'entrée est obligatoire.',
            'entrees.*.prix_max.integer' => 'Le prix maximum de l\'entrée doit être un entier.',
            'entrees.*.prix_max.min' => 'Le prix maximum de l\'entrée doit être au moins :min.',
            'entrees.*.image.required' => 'L\'image de l\'entrée est obligatoire.',
            'entrees.*.image.image' => 'L\'image de l\'entrée doit être une image.',

            'longitude.required' => 'La localisation est obligatoire.',

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

    public function addEntree()
    {
        $length = count($this->entrees);
        if ($length != 0) {

            // check if all fields are filled (entrees_count - 1) times
            $i = $this->entrees_count - 1;
            if (empty($this->entrees[$i]['nom']) || empty($this->entrees[$i]['ingredients']) || empty($this->entrees[$i]['prix_min']) || empty($this->entrees[$i]['image'])) {
                // $this->entrees_error = 'Veuillez remplir tous les champs de l\'entrée précédente';
                return;
            }

            $this->entrees[$i]['prix_max'] = $this->entrees[$i]['prix_min'];

            // check if nom is unique
            foreach ($this->entrees as $key => $entree) {
                if ($key == $i)
                    continue;
                if ($entree['nom'] == $this->entrees[$i]['nom']) {
                    $this->entrees_error = 'Ce nom d\'entrée existe déjà';
                    return;
                }
            }
        }


        $this->entrees_error = '';

        $this->entrees[] = [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
        ];

        $this->entrees_count++;
    }

    public function addPlat()
    {
        $length = count($this->plats);
        if ($length != 0) {
            $i = $this->plats_count - 1;
            if (empty($this->plats[$i]['nom']) || empty($this->plats[$i]['ingredients']) || empty($this->plats[$i]['accompagnements']) || empty($this->plats[$i]['prix_min']) || empty($this->plats[$i]['image'])) {
                return;
            }

            $this->plats[$i]['prix_max'] = $this->plats[$i]['prix_min'];

            foreach ($this->plats as $key => $plat) {
                if ($key == $i)
                    continue;
                if ($plat['nom'] == $this->plats[$i]['nom']) {
                    $this->plats_error = 'Ce nom de plat existe déjà';
                    return;
                }
            }
        }

        $this->plats_error = '';

        $this->plats[] = [
            'nom' => '',
            'ingredients' => '',
            'accompagnements' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ];

        $this->plats_count++;
    }

    public function addDessert()
    {
        $length = count($this->desserts);
        if ($length != 0) {
            $i = $this->desserts_count - 1;
            if (empty($this->desserts[$i]['nom']) || empty($this->desserts[$i]['ingredients']) || empty($this->desserts[$i]['prix_min']) || empty($this->desserts[$i]['image'])) {
                return;
            }

            $this->desserts[$i]['prix_max'] = $this->desserts[$i]['prix_min'];

            foreach ($this->desserts as $key => $dessert) {
                if ($key == $i)
                    continue;
                if ($dessert['nom'] == $this->desserts[$i]['nom']) {
                    $this->desserts_error = 'Ce nom de dessert existe déjà';
                    return;
                }
            }
        }

        $this->desserts_error = '';

        $this->desserts[] = [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ];

        $this->desserts_count++;
    }

    public function removeEntree($key)
    {
        unset($this->entrees[$key]);
        $this->entrees = array_values($this->entrees);
        $this->entrees_error = '';
        $this->entrees_count--;
    }

    public function removeDessert($key)
    {
        unset($this->desserts[$key]);
        $this->desserts = array_values($this->desserts);
        $this->desserts_error = '';
        $this->desserts_count--;
    }

    public function removePlat($key)
    {
        unset($this->plats[$key]);
        $this->plats = array_values($this->plats);
        $this->plats_error = '';
        $this->plats_count--;
    }

    public function checkEntries()
    {
        // dd($this->entrees);
        $cEntrees = count($this->entrees) - 1;
        $cPlats = count($this->plats) - 1;
        $cDesserts = count($this->desserts) - 1;

        if (empty($this->entrees[$cEntrees]['nom']) || empty($this->entrees[$cEntrees]['ingredients']) || empty($this->entrees[$cEntrees]['prix_min']) || empty($this->entrees[$cEntrees]['image'])) {
            $this->addError('entrees_error', 'Veuillez remplir tous les champs de l\'entrée précédente');
            // return;
        }

        if (empty($this->plats[$cPlats]['nom']) || empty($this->plats[$cPlats]['ingredients']) || empty($this->plats[$cPlats]['accompagnements']) || empty($this->plats[$cPlats]['prix_min'])) {
            $this->addError('plats_error', 'Veuillez remplir tous les champs du plat précédent');
            // return;
        }

        if (empty($this->desserts[$cDesserts]['nom']) || empty($this->desserts[$cDesserts]['ingredients']) || empty($this->desserts[$cDesserts]['prix_min'])) {
            $this->addError('desserts_error', 'Veuillez remplir tous les champs du dessert précédent');
            // return;
        }
    }

    public function store()
    {
        $this->validate();

        $separator = Utils::getRestaurantValueSeparator();
        $separator2 = Utils::getRestaurantImageSeparator();

        // Put all entrees in the same variable
        foreach ($this->entrees as $entree) {
            $this->e_nom .= $entree['nom'] . $separator;
            $this->e_ingredients .= $entree['ingredients'] . $separator;
            $this->e_prix_min .= $entree['prix_min'] . $separator;
            $this->e_prix_max .= $entree['prix_min'] . $separator;

            // upload image
            $uploadResult = AnnoncesUtils::storeImage($entree['image'], 'restaurants');
            $this->e_image .= $uploadResult->id . $separator2;
        }

        // Put all plats in the same variable
        foreach ($this->plats as $plat) {
            $this->p_nom .= $plat['nom'] . $separator;
            $this->p_ingredients .= $plat['ingredients'] . $separator;
            $this->p_accompagnements .= $plat['accompagnements'] . $separator;
            $this->p_prix_min .= $plat['prix_min'] . $separator;
            $this->p_prix_max .= $plat['prix_min'] . $separator;

            // upload image
            $uploadResult = AnnoncesUtils::storeImage($plat['image'], 'restaurants');
            $this->p_image .= $uploadResult->id . $separator2;
        }

        // Put all desserts in the same variable
        foreach ($this->desserts as $dessert) {
            $this->d_nom .= $dessert['nom'] . $separator;
            $this->d_ingredients .= $dessert['ingredients'] . $separator;
            $this->d_prix_min .= $dessert['prix_min'] . $separator;
            $this->d_prix_max .= $dessert['prix_min'] . $separator;

            // upload image
            $uploadResult = AnnoncesUtils::storeImage($dessert['image'], 'restaurants');
            $this->d_image .= $uploadResult->id . $separator2;
        }


        try {
            DB::beginTransaction();

            $restaurant = Restaurant::create([
                'e_nom' => $this->e_nom,
                'e_ingredients' => $this->e_ingredients,
                'e_prix_min' => $this->e_prix_min,
                'e_prix_max' => $this->e_prix_max,
                'e_image' => $this->e_image,

                'p_nom' => $this->p_nom,
                'p_ingredients' => $this->p_ingredients,
                'p_accompagnements' => $this->p_accompagnements,
                'p_prix_min' => $this->p_prix_min,
                'p_prix_max' => $this->p_prix_max,
                'p_image' => $this->p_image,

                'd_nom' => $this->d_nom,
                'd_ingredients' => $this->d_ingredients,
                'd_prix_min' => $this->d_prix_min,
                'd_prix_max' => $this->d_prix_max,
                'd_image' => $this->d_image,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Restaurant',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,

                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            $restaurant->annonce()->save($annonce);

            $references = [
                ['Equipements restauration', $this->equipements_restauration],
                ['Specialités', $this->specialites],
                ['Services', $this->services],
                ['Carte de consommation', $this->carte_consommation],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'restaurants');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
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
