<?php

namespace App\Livewire\Admin\Restaurant;

use App\Livewire\Admin\AnnonceBaseEdit;
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

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $restaurant;
    public $is_active;
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
    public $p_prix_min = 0;
    public $p_prix_max = 0;
    public $p_image;

    public $d_nom;
    public $d_ingredients;
    public $d_prix_min = 0;
    public $d_prix_max = 0;
    public $d_image;


    public $entrees = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
            'is_new' => true,
        ],
    ];
    public $old_entrees = [];
    public $entrees_count = 1;
    public $entrees_error = '';


    public $plats = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
            'is_new' => true,
        ],
    ];
    public $old_plats = [];
    public $plats_count = 1;
    public $plats_error = '';

    public $desserts = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
            'is_new' => true,
        ],
    ];
    public $old_desserts = [];
    public $desserts_count = 1;
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

    public $latitude;
    public $longitude;

    public $image;
    public $galerie = [];
    public $old_galerie = [];

    public function mount($restaurant)
    {
        $this->initialization();
        $this->restaurant = $restaurant;
        $this->entreprise_id = $restaurant->annonce->entreprise_id;
        $this->nom = $restaurant->annonce->titre;
        $this->description = $restaurant->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($restaurant->annonce->date_validite));
        $this->old_galerie = $restaurant->annonce->galerie()->get();
        $this->old_image = $restaurant->annonce->imagePrincipale;
        $this->is_active = $restaurant->annonce->is_active;
        $this->latitude = $restaurant->annonce->latitude;
        $this->longitude = $restaurant->annonce->longitude;
        $this->pays_id = $restaurant->annonce->ville->pays_id;
        $this->ville_id = $restaurant->annonce->ville_id;
        $this->quartier_id = $restaurant->annonce->quartier;
        $this->entreprise_id = $restaurant->annonce->entreprise_id;

        $this->villes = Ville::where('pays_id', $this->pays_id)->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->get();

        $this->entrees = $restaurant->entrees;
        foreach ($this->entrees as $key => $entree) {
            $this->entrees[$key]['is_new'] = false;
        }
        $this->plats = $restaurant->plats;
        foreach ($this->plats as $key => $plat) {
            $this->plats[$key]['is_new'] = false;
        }
        $this->desserts = $restaurant->desserts;
        foreach ($this->desserts as $key => $dessert) {
            $this->desserts[$key]['is_new'] = false;
        }

        $this->old_entrees = $this->entrees;
        $this->old_plats = $this->plats;
        $this->old_desserts = $this->desserts;

        $this->services = $restaurant->annonce->references('services')->pluck('id')->toArray();
        $this->equipements_restauration = $restaurant->annonce->references('equipements-restauration')->pluck('id')->toArray();
        $this->specialites = $restaurant->annonce->references('specialites')->pluck('id')->toArray();
        $this->carte_consommation = $restaurant->annonce->references('carte-consommation')->pluck('id')->toArray();
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

        $this->pays = Pays::all();
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->restaurant->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'nullable|min:3|max:255',
            'date_validite' => 'required|date|after:today',

            'entrees' => 'required|array|min:1',
            'plats' => 'required|array|min:1',
            'desserts' => 'required|array|min:1',

            'pays_id' => 'required|exists:pays,id',
            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required|string|max:255',

            'longitude' => 'required|string',
            'latitude' => 'required|string',

            // 'image' => 'nullable|image|max:1024',
            // 'galerie.*' => 'nullable|image|max:1024',
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
            'latitude.required' => 'La latitude est obligatoire.',

            'entrees.required' => 'Le champ entrées est obligatoire.',
            'entrees.array' => 'Le champ entrées doit être un tableau.',
            'entrees.min' => 'Le champ entrées doit contenir au moins un élément.',

            'plats.required' => 'Le champ plats est obligatoire.',
            'plats.array' => 'Le champ plats doit être un tableau.',
            'plats.min' => 'Le champ plats doit contenir au moins un élément.',

            'desserts.required' => 'Le champ desserts est obligatoire.',
            'desserts.array' => 'Le champ desserts doit être un tableau.',
            'desserts.min' => 'Le champ desserts doit contenir au moins un élément.',
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

    public function addEntree()
    {
        $result = $this->checkUniqueEntree();
        if (!$result) {
            return;
        }

        $this->entrees_error = '';

        $this->entrees[] = [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ];
    }

    private function checkUniqueEntree(bool $isUpdating = false): bool
    {
        $length = count($this->entrees);
        if ($length != 0) {
            $i = $length - 1;
            if (empty($this->entrees[$i]['nom']) || empty($this->entrees[$i]['ingredients']) || empty($this->entrees[$i]['prix_min']) || empty($this->entrees[$i]['image'])) {
                $this->entrees_error = 'Veuillez remplir tous les champs';
                return false;
            }

            foreach ($this->entrees as $key => $entree) {
                if ($key == $i)
                    continue;
                if ($entree['nom'] == $this->entrees[$i]['nom']) {
                    $this->entrees_error = 'Ce nom d\'entrée existe déjà';

                    if ($isUpdating) {
                        $this->dispatch('swal:modal', [
                            'icon' => 'error',
                            'title' => __('Opération échouée'),
                            'message' => __('Une entrée avec le même nom existe déjà'),
                        ]);
                    }

                    return false;
                }
            }
        }

        return true;
    }

    public function addPlat()
    {
        $result = $this->checkUniquePlat();
        if (!$result) {
            return;
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
    }

    private function checkUniquePlat(bool $isUpdating = false): bool
    {
        $length = count($this->plats);
        if ($length != 0) {
            $i = $length - 1;
            if (empty($this->plats[$i]['nom']) || empty($this->plats[$i]['ingredients']) || empty($this->plats[$i]['prix_min']) || empty($this->plats[$i]['image'])) {
                $this->plats_error = 'Veuillez remplir tous les champs';
                return false;
            }

            foreach ($this->plats as $key => $plat) {
                if ($key == $i)
                    continue;
                if ($plat['nom'] == $this->plats[$i]['nom']) {
                    $this->plats_error = 'Ce nom de plat existe déjà';

                    if ($isUpdating) {
                        $this->dispatch('swal:modal', [
                            'icon' => 'error',
                            'title' => __('Opération échouée'),
                            'message' => __('Un plat avec le même nom existe déjà'),
                        ]);
                    }

                    return false;
                }
            }
        }

        return true;
    }

    public function addDessert()
    {
        $result = $this->checkUniqueDessert();
        if (!$result) {
            return;
        }

        $this->desserts_error = '';

        $this->desserts[] = [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
            'image' => null,
        ];
    }

    private function checkUniqueDessert(bool $isUpdating = false): bool
    {
        $length = count($this->desserts);
        if ($length != 0) {
            $i = $length - 1;
            if (empty($this->desserts[$i]['nom']) || empty($this->desserts[$i]['ingredients']) || empty($this->desserts[$i]['prix_min']) || empty($this->desserts[$i]['image'])) {
                $this->desserts_error = 'Veuillez remplir tous les champs';
                return false;
            }

            foreach ($this->desserts as $key => $dessert) {
                if ($key == $i)
                    continue;
                if ($dessert['nom'] == $this->desserts[$i]['nom']) {
                    $this->desserts_error = 'Ce nom de dessert existe déjà';

                    if ($isUpdating) {
                        $this->dispatch('swal:modal', [
                            'icon' => 'error',
                            'title' => __('Opération échouée'),
                            'message' => __('Un dessert avec le même nom existe déjà'),
                        ]);
                    }

                    return false;
                }
            }
        }

        return true;
    }

    public function removeEntree($key)
    {
        unset($this->entrees[$key]);
        $this->entrees = array_values($this->entrees);
        $this->entrees_error = '';
    }

    public function removePlat($key)
    {
        unset($this->plats[$key]);
        $this->plats = array_values($this->plats);
        $this->plats_error = '';
    }

    public function removeDessert($key)
    {
        unset($this->desserts[$key]);
        $this->desserts = array_values($this->desserts);
        $this->desserts_error = '';
    }

    public function update()
    {
        $this->validate();


        if (!$this->checkUniqueEntree(true) || !$this->checkUniquePlat(true) || !$this->checkUniqueDessert(true)) {
            return;
        }

        if ($this->is_active && $this->date_validite < date('Y-m-d')) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('La date de validité doit être supérieure à la date du jour'),
            ]);
            return;
        }

        $separator = Utils::getRestaurantValueSeparator();
        $separator2 = Utils::getRestaurantImageSeparator();

        // try {
        DB::beginTransaction();

        // Put all entrees in the same variable
        foreach ($this->entrees as $index => $entree) {
            $this->e_nom .= $entree['nom'] . $separator;
            $this->e_ingredients .= $entree['ingredients'] . $separator;
            $this->e_prix_min .= $entree['prix_min'] . $separator;
            $this->e_prix_max .= $entree['prix_min'] . $separator;

            if (is_string($entree['image'])) {
                $oldEntreesCollection = collect($this->old_entrees);
                $tmp_entree = $oldEntreesCollection->where('id', $entree['id'])->first();
                $this->e_image .= $tmp_entree['image_id'] . $separator2;
                continue;
            }

            if ($entree['is_new']) {
                $uploadResult = AnnoncesUtils::storeImage($entree['image'], 'restaurants');
                $this->e_image .= "{$uploadResult->id}{$separator2}";
            } else {
                $uploadResult = AnnoncesUtils::updateImage($entree['image'], 'restaurants', $this->old_entrees[$index]['image_id']);
                $this->e_image .= "{$uploadResult->id}{$separator2}";
            }
        }

        // Put all plats in the same variable
        foreach ($this->plats as $index => $plat) {
            $this->p_nom .= $plat['nom'] . $separator;
            $this->p_ingredients .= $plat['ingredients'] . $separator;
            $this->p_prix_min .= $plat['prix_min'] . $separator;
            $this->p_prix_max .= $plat['prix_min'] . $separator;

            if (is_string($plat['image'])) {
                $oldPlatsCollection = collect($this->old_plats);
                $tmp_plat = $oldPlatsCollection->where('id', $plat['id'])->first();
                $this->p_image .= $tmp_plat['image_id'] . $separator2;
                continue;
            }

            if ($plat['is_new']) {
                $uploadResult = AnnoncesUtils::storeImage($plat['image'], 'restaurants');
                $this->p_image .= "{$uploadResult->id}{$separator2}";
            } else {
                $uploadResult = AnnoncesUtils::updateImage($plat['image'], 'restaurants', $this->old_plats[$index]['image_id']);
                $this->p_image .= "{$uploadResult->id}{$separator2}";
            }
        }

        // Put all desserts in the same variable
        foreach ($this->desserts as $index => $dessert) {
            $this->d_nom .= $dessert['nom'] . $separator;
            $this->d_ingredients .= $dessert['ingredients'] . $separator;
            $this->d_prix_min .= $dessert['prix_min'] . $separator;
            $this->d_prix_max .= $dessert['prix_min'] . $separator;

            if (is_string($dessert['image'])) {
                $oldDessertsCollection = collect($this->old_desserts);
                $tmp_dessert = $oldDessertsCollection->where('id', $dessert['id'])->first();
                $this->d_image .= $tmp_dessert['image_id'] . $separator2;
                continue;
            }

            if ($dessert['is_new']) {
                $uploadResult = AnnoncesUtils::storeImage($dessert['image'], 'restaurants');
                $this->d_image .= "{$uploadResult->id}{$separator2}";
            } else {
                $uploadResult = AnnoncesUtils::updateImage($dessert['image'], 'restaurants', $this->old_desserts[$index]['image_id']);
                $this->d_image .= "{$uploadResult->id}{$separator2}";
            }
        }

        $restaurant = $this->restaurant;
        $restaurant->update([
            'e_nom' => $this->e_nom,
            'e_ingredients' => $this->e_ingredients,
            'e_prix_min' => $this->e_prix_min,
            'e_prix_max' => $this->e_prix_max,
            'e_image' => $this->e_image,

            'p_nom' => $this->p_nom,
            'p_ingredients' => $this->p_ingredients,
            'p_prix_min' => $this->p_prix_min,
            'p_prix_max' => $this->p_prix_max,
            'p_image' => $this->p_image,

            'd_nom' => $this->d_nom,
            'd_ingredients' => $this->d_ingredients,
            'd_prix_min' => $this->d_prix_min,
            'd_prix_max' => $this->d_prix_max,
            'd_image' => $this->d_image,
        ]);

        $annonce = $restaurant->annonce;
        $annonce->update([
            'titre' => $this->nom,
            'description' => $this->description,
            'date_validite' => $this->date_validite,
            'entreprise_id' => $this->entreprise_id,
            'ville_id' => $this->ville_id,
            'quartier' => $this->quartier_id,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'is_active' => $this->is_active,
        ]);

        $references = [
            ['Equipements restauration', $this->equipements_restauration],
            ['Specialités', $this->specialites],
            ['Services', $this->services],
            ['Carte de consommation', $this->carte_consommation],
        ];

        AnnoncesUtils::updateManyReference($this->restaurant->annonce, $references);

        AnnoncesUtils::updateGalerie($this->image, $this->restaurant->annonce, $this->galerie, $this->deleted_old_galerie, 'restaurants');

        DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     $this->dispatch('swal:modal', [
        //         'icon' => 'error',
        //         'title' => __('Opération échouée'),
        //         'message' => __('Une erreur est survenue lors de la mise à jour de l\'annonce'),
        //     ]);
        //     Log::error($th->getMessage());
        //     return;
        // }

        session()->flash('success', 'L\'annonce a bien été mise à jour');
        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.restaurant.edit');
    }
}
