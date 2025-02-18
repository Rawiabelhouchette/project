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
    public $last_produit_id = 0;

    public $produits = [
        [
            'nom' => '',
            'prix' => '',
            'image' => '',
            'accompagnements' => '',
            'image_id' => null,
            'is_new' => true,
        ]
    ];

    public $old_produits = [];

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
        $this->latitude = $fastFood->annonce->latitude;
        $this->longitude = $fastFood->annonce->longitude;
        $this->pays_id = $fastFood->annonce->ville->pays_id;
        $this->ville_id = $fastFood->annonce->ville_id;
        $this->quartier_id = $fastFood->annonce->quartier;
        $this->entreprise_id = $fastFood->annonce->entreprise_id;

        $this->villes = Ville::where('pays_id', $this->pays_id)->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->get();

        $this->produits = $fastFood->produits;
        foreach ($this->produits as $key => $produit) {
            $this->produits[$key]['is_new'] = false;
        }
        $this->last_produit_id = count($this->produits);
        $this->old_produits = $this->produits;

        $this->services = $fastFood->annonce->references('services')->pluck('id')->toArray();
        $this->equipements_restauration = $fastFood->annonce->references('equipements-restauration')->pluck('id')->toArray();
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
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->fastFood->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'nullable|min:3|max:255',
            'date_validite' => 'required|date|after:today',

            'produits' => 'required|array|min:1',

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
        $result = $this->checkUniqueProduit();
        if (!$result) {
            return;
        }

        $this->produits_error = '';

        $this->produits[] = [
            'id' => $this->last_produit_id + 1,
            'nom' => '',
            'prix' => '',
            'image' => '',
            'accompagnements' => '',
            'is_new' => true,
        ];
    }

    private function checkUniqueProduit(bool $isUpdating = false): bool
    {
        $length = count($this->produits);
        if ($length != 0) {
            $i = $length - 1;
            if (empty($this->produits[$i]['nom']) || empty($this->produits[$i]['prix']) || empty($this->produits[$i]['image']) || empty($this->produits[$i]['accompagnements'])) {
                return false;
            }

            foreach ($this->produits as $key => $produit) {
                if ($key == $i)
                    continue;
                if ($produit['nom'] == $this->produits[$i]['nom']) {
                    $this->produits_error = 'Ce nom de produit existe déjà';

                    if ($isUpdating) {
                        $this->dispatch('swal:modal', [
                            'icon' => 'error',
                            'title' => __('Opération échouée'),
                            'message' => __('Un produit avec le même nom existe déjà'),
                        ]);
                    }

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

    public function update()
    {
        $this->validate();


        if (!$this->checkUniqueProduit(true)) {
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

        try {
            DB::beginTransaction();

            // Put all produits in the same variable
            foreach ($this->produits as $index => $produit) {
                $this->nom_produit .= $produit['nom'] . $separator;
                $this->prix_produit .= $produit['prix'] . $separator;
                $this->accompagnements_produit .= $produit['accompagnements'] . $separator;


                // check if $produit image is a string or an object
                if (is_string($produit['image'])) {
                    $oldProduitsCollection = collect($this->old_produits);
                    $tmp_produit = $oldProduitsCollection->where('id', $produit['id'])->first();
                    $this->image_produit .= $tmp_produit['image_id'] . $separator2;
                    continue;
                }


                // dump($produit);
                // dd($this->old_produits);

                // upload image
                if ($produit['is_new']) {
                    $uploadResult = AnnoncesUtils::storeImage($produit['image'], 'fast-foods');
                    $this->image_produit .= "{$uploadResult->id}{$separator2}";
                } else {
                    $uploadResult = AnnoncesUtils::updateImage($produit['image'], 'fast-foods', $this->old_produits[$index]['image_id']);
                    $this->image_produit .= "{$uploadResult->id}{$separator2}";
                }
            }


            // dump($this->produits);
            // dd($this->old_produits);

            $this->fastFood->update([
                'nom_produit' => $this->nom_produit,
                'accompagnement_produit' => $this->accompagnements_produit,
                'prix_produit' => $this->prix_produit,
                'image_produit' => $this->image_produit,
            ]);

            $this->fastFood->annonce->update([
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
                ['Services', $this->services],
            ];

            AnnoncesUtils::updateManyReference($this->fastFood->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->fastFood->annonce, $this->galerie, $this->deleted_old_galerie, 'fast-foods');

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
        return view('livewire.admin.fast-food.edit');
    }
}
