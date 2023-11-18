<?php

namespace App\Livewire\Admin\Auberge;

use App\Models\Annonce;
use App\Models\Auberge;
use App\Models\Entreprise;
use App\Models\Fichier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $nom ;
    public $type ;
    public $description ;
    public $nombre_chambre ;
    public $nombre_personne ;
    public $superficie ;
    public $prix_min ;
    public $prix_max ;
    public $entreprise_id;
    public $entreprises = [];
    public $types_lit = [];
    public $list_types_lit = [];
    public $commodites = [];
    public $list_commodites = [];
    public $services = [];
    public $list_services = [];
    public $equipements_herbegement = [];
    public $list_equipements_herbegement = [];
    public $equipements_salle_bain = [];
    public $list_equipements_salle_bain = [];
    public $equipements_cuisine = [];
    public $list_equipements_cuisine = [];
    public $galerie = [];

    public $date_validite;
    public $heure_validite;

    public function mount()
    {
        $this->initialization();
    }

    private function initialization()
    {
        $this->entreprises = Entreprise::all();

        $tmp_commodite = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'commodites-hebergement')->first();
        $tmp_commodite ?
        $this->list_commodites = ReferenceValeur::where('reference_id', $tmp_commodite->id)->select('valeur', 'id')->get() :
        $this->list_commodites = [];

        $tmp_types_lit = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'types-de-lit')->first();
        $tmp_types_lit ?
        $this->list_types_lit = ReferenceValeur::where('reference_id', $tmp_types_lit->id)->select('valeur', 'id')->get() :
        $this->list_types_lit = [];

        $tmp_services = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'services')->first();
        $tmp_services ?
        $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
        $this->list_services = [];

        $tmp_equipements_herbegement = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-hebergement')->first();
        $tmp_equipements_herbegement ?
        $this->list_equipements_herbegement = ReferenceValeur::where('reference_id', $tmp_equipements_herbegement->id)->select('valeur', 'id')->get() :
        $this->list_equipements_herbegement = [];

        $tmp_equipements_salle_bain = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-salle-de-bain')->first();
        $tmp_equipements_salle_bain ?
        $this->list_equipements_salle_bain = ReferenceValeur::where('reference_id', $tmp_equipements_salle_bain->id)->select('valeur', 'id')->get() :
        $this->list_equipements_salle_bain = [];

        $tmp_equipements_cuisine = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-cuisine')->first();
        $tmp_equipements_cuisine ?
        $this->list_equipements_cuisine = ReferenceValeur::where('reference_id', $tmp_equipements_cuisine->id)->select('valeur', 'id')->get() :
        $this->list_equipements_cuisine = [];
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|max:255|unique:annonces,titre,id,entreprise_id',
            'type' => 'nullable',
            'description' => 'nullable|min:3|max:255',
            'nombre_chambre' => 'nullable|numeric',
            'nombre_personne' => 'nullable|numeric',
            'superficie' => 'nullable|numeric',
            'prix_min' => 'nullable|numeric',
            'prix_max' => 'nullable|numeric',
            'types_lit' => 'nullable',
            'commodites' => 'nullable',
            'services' => 'nullable',
            'equipements_herbegement' => 'nullable',
            'equipements_salle_bain' => 'nullable',
            'equipements_cuisine' => 'nullable',
            'galerie.*' => 'image|max:5120',
            'galerie' => 'max:10',
            'date_validite' => 'required|date|after:today',
            // 'heure_validite' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.exists' => 'L\'entreprise n\'existe pas',
            'nom.required' => 'Le nom est obligatoire',
            'galerie.*.image' => 'Le fichier doit être une image',
            'galerie.*.max' => 'Le fichier ne doit pas dépasser 5 Mo',
            'galerie.max' => 'Vous ne pouvez pas charger plus de 10 images',
            'date_validite.required' => 'La date de validité est obligatoire',
            'date_validite.date' => 'La date de validité doit être une date',
            'date_validite.after' => 'La date de validité doit être supérieure à la date du jour',
            'heure_validite.required' => 'L\'heure de validité est obligatoire',
        ];
    }

    public function removeGalerie($index)
    {
        unset($this->galerie[$index]);
        $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
    }

    // public function updated

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $date_validite = $this->date_validite . ' ' . $this->heure_validite;

            $auberge = Auberge::create([
                'nombre_chambre' => $this->nombre_chambre,
                'nombre_personne' => $this->nombre_personne,
                'superficie' => $this->superficie,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Auberge',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $auberge->annonce()->save($annonce);

            if ($this->types_lit) {
                foreach ($this->types_lit as $value) {
                    $annonce->references()->attach($value, 
                    [
                        'titre' => 'Types de lit',
                        'slug' => 'types-de-lit',
                    ]);
                }
            }

            if ($this->commodites) {
                foreach ($this->commodites as $value) {
                    $annonce->references()->attach($value, 
                    [
                        'titre' => 'Commodités',
                        'slug' => 'commodites-hebergement',
                    ]);
                }
            }

            if ($this->services) {
                foreach ($this->services as $value) {
                    $annonce->references()->attach($value, 
                    [
                        'titre' => 'Services',
                        'slug' => 'services',
                    ]);
                }
            }

            if ($this->equipements_herbegement) {
                foreach ($this->equipements_herbegement as $value) {
                    $annonce->references()->attach($value, 
                    [
                        'titre' => 'Equipements hébergement',
                        'slug' => 'equipements-hebergement',
                    ]);
                }
            }

            if ($this->equipements_salle_bain) {
                foreach ($this->equipements_salle_bain as $value) {
                    $annonce->references()->attach($value, 
                    [
                        'titre' => 'Equipements salle de bain',
                        'slug' => 'equipements-salle-de-bain',
                    ]);
                }
            }

            if ($this->equipements_cuisine) {
                foreach ($this->equipements_cuisine as $value) {
                    $annonce->references()->attach($value, 
                    [
                        'titre' => 'Equipements cuisine',
                        'slug' => 'equipements-cuisine',
                    ]);
                }
            }

            if ($this->galerie) {
                foreach ($this->galerie as $image) {
                    $image->store('public/annonces');
                    $fichier = Fichier::create([
                        'nom' => $image->hashName(),
                        'chemin' => 'annonces/' . $image->hashName(),
                        'extension' => $image->extension(),
                    ]);

                    $annonce->galerie()->attach($fichier->id);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'auberge'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        $this->reset();
        $this->initialization();

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('L\'auberge a bien été ajoutée'),
        ]);
    }


    public function render()
    {
        return view('livewire.admin.auberge.create');
    }
}
