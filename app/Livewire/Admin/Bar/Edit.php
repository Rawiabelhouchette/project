<?php

namespace App\Livewire\Admin\Bar;

use App\Livewire\Admin\AnnonceBaseEdit;
use App\Models\Entreprise;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\Ville;
use App\Utils\AnnoncesUtils;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $nom;
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;
    public $type_bar;
    public $capacite_accueil;
    public $is_active;

    public $bar;

    public $prix_min;
    public $prix_max;

    public $types_musique = [];
    public $list_types_musique = [];

    public $equipements_vie_nocturne = [];
    public $list_equipements_vie_nocturne = [];

    public $commodites_vie_nocturne = [];
    public $list_commodites_vie_nocturne = [];

    public $entreprises = [];

    public $pays = [];
    public $pays_id;

    public $villes = [];
    public $ville_id;

    public $quartiers = [];
    public $quartier_id;

    public $latitude;
    public $longitude;


    public function mount($bar)
    {
        $this->initialization();

        $this->bar = $bar;
        $this->nom = $bar->annonce->titre;
        $this->type = $bar->annonce->type;
        $this->description = $bar->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($bar->annonce->date_validite));
        $this->entreprise_id = $bar->annonce->entreprise_id;
        $this->type_bar = $bar->type_bar;
        $this->type_musique = $bar->type_musique;
        $this->capacite_accueil = $bar->capacite_accueil;
        $this->prix_min = $bar->prix_min;
        $this->prix_max = $bar->prix_max;
        $this->is_active = $bar->annonce->is_active;
        $this->old_galerie = $bar->annonce->galerie()->get();
        $this->equipements_vie_nocturne = $bar->annonce->references('equipements-vie-nocturne')->pluck('id')->toArray();
        $this->commodites_vie_nocturne = $bar->annonce->references('commodites-vie-nocturne')->pluck('id')->toArray();
        $this->old_image = $bar->annonce->imagePrincipale;

        $this->pays_id = $bar->annonce->ville->pays_id;
        $this->ville_id = $bar->annonce->ville_id;
        $this->quartier_id = $bar->annonce->quartier;
        $this->villes = Ville::where('pays_id', $this->pays_id)->orderBy('nom')->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->orderBy('nom')->get();
        $this->latitude = $bar->annonce->latitude;
        $this->longitude = $bar->annonce->longitude;
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

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
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->bar->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'nullable|string|min:3',
            'type_bar' => 'nullable|string',
            'capacite_accueil' => 'nullable|integer',

            'equipements_vie_nocturne' => 'nullable|array',
            'equipements_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'commodites_vie_nocturne' => 'nullable|array',
            'commodites_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'types_musique' => 'nullable|array',
            'types_musique.*' => 'nullable|integer|exists:reference_valeurs,id',

            'is_active' => 'required|boolean',
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',

            'longitude' => 'required',
            'latitude' => 'required',

            'ville_id' => 'required|exists:villes,id',
            'quartier_id' => 'required',

            'image' => 'nullable|image|max:5120|mimes:jpeg,png,jpg',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',
            'nom.unique' => 'Ce nom existe déjà',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.min' => 'La description doit contenir au moins 3 caractères',
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.integer' => 'L\'entreprise doit être un entier',
            'entreprise_id.exists' => 'L\'entreprise n\'existe pas',
            'type_bar.string' => 'Le type de bar doit être une chaîne de caractères',
            'type_musique.string' => 'Le type de musique doit être une chaîne de caractères',
            'capacite_accueil.integer' => 'La capacité d\'accueil doit être un entier',
            'equipements_vie_nocturne.array' => 'Les équipements de vie nocturne doivent être un tableau',
            'equipements_vie_nocturne.*.integer' => 'Les équipements de vie nocturne doivent être des entiers',
            'equipements_vie_nocturne.*.exists' => 'Les équipements de vie nocturne n\'existent pas',
            'commodites_vie_nocturne.array' => 'Les commodités de vie nocturne doivent être un tableau',
            'commodites_vie_nocturne.*.integer' => 'Les commodités de vie nocturne doivent être des entiers',
            'commodites_vie_nocturne.*.exists' => 'Les commodités de vie nocturne n\'existent pas',
            'is_active.required' => 'Le statut est obligatoire',
            'is_active.boolean' => 'Le statut doit être un booléen',
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

    public function update()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->bar->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);


            $this->bar->update([
                'type_bar' => $this->type_bar,
                'capacite_accueil' => $this->capacite_accueil,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $references = [
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités de vie nocturne', $this->commodites_vie_nocturne],
                ['Types de musique', [$this->types_musique]],
            ];

            AnnoncesUtils::updateManyReference($this->bar->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->bar->annonce, $this->galerie, $this->deleted_old_galerie, 'bars');

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
        session()->flash('success', 'L\'annonce a bien été ajoutée');
        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.bar.edit');
    }
}
