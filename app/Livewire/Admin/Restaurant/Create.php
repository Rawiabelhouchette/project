<?php

namespace App\Livewire\Admin\Restaurant;

use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Restaurant;
use App\Utils\AnnoncesUtils;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Create extends Component
{
    use WithFileUploads;

    public $nom;
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;

    public $e_nom;
    public $e_ingredients;
    public $e_prix_min = 0;
    public $e_prix_max = 0;

    public $p_nom;
    public $p_ingredients;
    public $p_prix_min = 0;
    public $p_prix_max = 0;

    public $d_nom;
    public $d_ingredients;
    public $d_prix_min = 0;
    public $d_prix_max = 0;

    public $equipements_restauration = [];
    public $list_equipements_restauration = [];

    public $specialites = [];
    public $list_specialites = [];

    public $carte_consommation = [];
    public $list_carte_consommation = [];


    public $entreprises = [];
    public $galerie = [];
    public $image;

    public function mount()
    {
        $this->initialization();
    }

    private function initialization()
    {
        $this->entreprises = Entreprise::all();
        
        $tmp_equipement_restauration = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-restauration')->first();
        $tmp_equipement_restauration ?
            $this->list_equipements_restauration = ReferenceValeur::where('reference_id', $tmp_equipement_restauration->id)->select('valeur', 'id')->get() :
            $this->list_equipements_restauration = [];

        $tmp_specialite = Reference::where('slug_type', 'restauration')->where('slug_nom', 'specialites')->first();
        $tmp_specialite ?
            $this->list_specialites = ReferenceValeur::where('reference_id', $tmp_specialite->id)->select('valeur', 'id')->get() :
            $this->list_specialites = [];

        $tmp_carte_consommation = Reference::where('slug_type', 'restauration')->where('slug_nom', 'carte-de-consommation')->first();
        $tmp_carte_consommation ?
            $this->list_carte_consommation = ReferenceValeur::where('reference_id', $tmp_carte_consommation->id)->select('valeur', 'id')->get() :
            $this->list_carte_consommation = [];
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'e_nom' => 'required|string|min:3',
            'e_ingredients' => 'nullable|string|min:3',
            'e_prix_min' => 'nullable|integer|min:0|lte:e_prix_max',
            'e_prix_max' => 'nullable|integer|min:0',
            'p_nom' => 'required|string|min:3',
            'p_ingredients' => 'nullable|string|min:3',
            'p_prix_min' => 'nullable|integer|min:0|lte:p_prix_max',
            'p_prix_max' => 'nullable|integer|min:0',
            'd_nom' => 'required|string|min:3',
            'd_ingredients' => 'nullable|string|min:3',
            'd_prix_min' => 'nullable|integer|min:0|lte:d_prix_max',
            'd_prix_max' => 'nullable|integer|min:0',
            'equipements_restauration' => 'nullable|array',
            'equipements_restauration.*' => 'nullable|integer|exists:reference_valeurs,id',
            'specialites' => 'nullable|array',
            'specialites.*' => 'nullable|integer|exists:reference_valeurs,id',
            'carte_consommation' => 'nullable|array',
            'carte_consommation.*' => 'nullable|integer|exists:reference_valeurs,id',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image',
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
        ];
    }

    public function removeGalerie($index)
    {
        unset($this->galerie[$index]);
        $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $restaurant = Restaurant::create([
                'e_nom' => $this->e_nom,
                'e_ingredients' => $this->e_ingredients,
                'e_prix_min' => $this->e_prix_min,
                'e_prix_max' => $this->e_prix_max,

                'p_nom' => $this->p_nom,
                'p_ingredients' => $this->p_ingredients,
                'p_prix_min' => $this->p_prix_min,
                'p_prix_max' => $this->p_prix_max,

                'd_nom' => $this->d_nom,
                'd_ingredients' => $this->d_ingredients,
                'd_prix_min' => $this->d_prix_min,
                'd_prix_max' => $this->d_prix_max,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Restaurant',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $restaurant->annonce()->save($annonce);

            $references = [
                ['Equipements restauration', $this->equipements_restauration],
                ['Specialités', $this->specialites],
                ['Carte de consommation', $this->carte_consommation],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'restaurants');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }
        
        session()->flash('success', 'L\'annonce a bien été ajoutée');
        return redirect()->route('restaurants.create');
    }

    
    public function render()
    {
        return view('livewire.admin.restaurant.create');
    }
}
