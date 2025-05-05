<?php

namespace App\Livewire\Admin\BoiteDeNuit;

use App\Livewire\Admin\AnnonceBaseEdit;
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

class Edit extends Component
{
    use AnnonceBaseEdit, CustomValidation, WithFileUploads;

    public $nom;

    public $type;

    public $description;

    public $date_validite;

    public $entreprise_id;

    public $boiteDeNuit;

    public $commodites = [];

    public $list_commodites = [];

    public $services = [];

    public $list_services = [];

    public $types_musique = [];

    public $list_types_musique = [];

    public $equipements_vie_nocturne = [];

    public $list_equipements_vie_nocturne = [];

    public $entreprises = [];

    public $is_active;

    public $pays = [];

    public $pays_id;

    public $villes = [];

    public $ville_id;

    public $quartiers = [];

    public $quartier_id;

    public $latitude;

    public $longitude;

    public function mount($boiteDeNuit)
    {
        $this->initialization();
        $this->boiteDeNuit = $boiteDeNuit;
        $this->entreprise_id = $boiteDeNuit->annonce->entreprise_id;
        $this->nom = $boiteDeNuit->annonce->titre;
        $this->is_active = $boiteDeNuit->annonce->is_active;
        $this->description = $boiteDeNuit->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($boiteDeNuit->annonce->date_validite));
        $this->commodites = $boiteDeNuit->annonce->references('commodites-hebergement')->pluck('id')->toArray();
        $this->services = $boiteDeNuit->annonce->references('services-proposes')->pluck('id')->toArray();
        $this->types_musique = $boiteDeNuit->annonce->references('types-de-musique')->pluck('id')->toArray();
        $this->equipements_vie_nocturne = $boiteDeNuit->annonce->references('equipements-vie-nocturne')->pluck('id')->toArray();
        $this->old_galerie = $boiteDeNuit->annonce->galerie()->get();
        $this->old_image = $boiteDeNuit->annonce->imagePrincipale;

        $this->pays_id = $boiteDeNuit->annonce->ville->pays_id;
        $this->ville_id = $boiteDeNuit->annonce->ville_id;
        $this->quartier_id = $boiteDeNuit->annonce->quartier;
        $this->villes = Ville::where('pays_id', $this->pays_id)->orderBy('nom')->get();
        $this->quartiers = Quartier::where('ville_id', $this->ville_id)->orderBy('nom')->get();
        $this->latitude = $boiteDeNuit->annonce->latitude;
        $this->longitude = $boiteDeNuit->annonce->longitude;
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

        $tmp_services = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'services-proposes')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $tmp_types_musique = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'types-de-musique')->first();
        $tmp_types_musique ?
            $this->list_types_musique = ReferenceValeur::where('reference_id', $tmp_types_musique->id)->select('valeur', 'id')->get() :
            $this->list_types_musique = [];

        $tmp_types_musique = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'types-de-musique')->first();
        $tmp_types_musique ?
            $this->list_types_musique = ReferenceValeur::where('reference_id', $tmp_types_musique->id)->select('valeur', 'id')->get() :
            $this->list_types_musique = [];

        $tmp_equipements_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'equipements-vie-nocturne')->first();
        $tmp_equipements_vie_nocturne ?
            $this->list_equipements_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_equipements_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vie_nocturne = [];

        $this->pays = Pays::orderBy('nom')->get();
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3',
            'is_active' => 'required|boolean',
            'description' => 'nullable|min:3',

            'commodites' => 'nullable',
            'services' => 'nullable',
            'types_musique' => 'nullable',
            'equipements_vie_nocturne' => 'nullable',

            'image' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,heic',
            'galerie' => 'array|max:10',
            'galerie.*' => 'image|max:5120|mimes:jpeg,png,jpg,heic',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Veuillez choisir une entreprise'),
            'entreprise_id.exists' => __('Veuillez choisir une entreprise valide'),
            'nom.required' => __('Veuillez renseigner le nom de l\'boiteDeNuit'),
            'nom.string' => __('Le nom de l\'boiteDeNuit doit être une chaine de caractères'),
            'nom.min' => __('Le nom de l\'boiteDeNuit doit contenir au moins :min caractères'),
            'nom.max' => __('Le nom de l\'boiteDeNuit ne doit pas dépasser :max caractères'),
            'nom.unique' => __('Le nom de l\'boiteDeNuit est déjà utilisé'),
            'is_active.required' => __('Veuillez renseigner l\'état de l\'boiteDeNuit'),
            'is_active.boolean' => __('L\'état de l\'boiteDeNuit doit être soit vrai soit faux'),
            'description.min' => __('La description de l\'boiteDeNuit doit contenir au moins :min caractères'),
            'description.max' => __('La description de l\'boiteDeNuit ne doit pas dépasser :max caractères'),

            'commodites.*.exists' => __('Veuillez choisir une commodité valide'),
            'services.*.exists' => __('Veuillez choisir un service valide'),
            'types_musique.*.exists' => __('Veuillez choisir un type de musique valide'),
            'equipements_vie_nocturne.*.exists' => __('Veuillez choisir un équipement de vie nocturne valide'),

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

    public function update()
    {
        if (! $this->validateWithCustom()) {
            return;
        }

        try {
            DB::beginTransaction();

            $this->boiteDeNuit->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,

                'ville_id' => $this->ville_id,
                'quartier' => $this->quartier_id,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]);

            // $this->boiteDeNuit->update([]);

            $references = [
                ['Types de musique', $this->types_musique],
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités hébergement', $this->commodites],
                ['Services proposés', $this->services],
            ];

            AnnoncesUtils::updateManyReference($this->boiteDeNuit->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->boiteDeNuit->annonce, $this->galerie, $this->deleted_old_galerie, 'boite-de-nuits');

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

        // ! CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', 'L\'annonce a bien été ajoutée');

        return redirect()->route('public.annonces.list');
    }

    public function render()
    {
        return view('livewire.admin.boite-de-nuit.edit');
    }
}
