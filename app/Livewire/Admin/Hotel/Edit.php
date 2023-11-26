<?php

namespace App\Livewire\Admin\Hotel;

use Livewire\Component;
use App\Models\Entreprise;
use App\Models\Fichier;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $nom;
    public $type;
    public $type_hebergement;
    public $is_active;
    public $description;
    public $nombre_chambre;
    public $nombre_personne;
    public $nombre_salles_bain;
    public $superficie;
    public $prix_min;
    public $prix_max;
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
    public $old_galerie = [];
    public $is_old_galerie = true;
    public $date_validite;
    public $heure_validite;
    public $hotel;

    public function mount($hotel)
    {
        $this->initialization();
        $this->hotel = $hotel;
        $this->entreprise_id = $hotel->annonce->entreprise_id;
        $this->nom = $hotel->annonce->titre;
        $this->is_active = $hotel->annonce->is_active;
        $this->description = $hotel->annonce->description;
        $this->nombre_chambre = $hotel->nombre_chambre;
        $this->nombre_personne = $hotel->nombre_personne;
        $this->type_hebergement = $hotel->type;
        $this->nombre_salles_bain = $hotel->nombre_salles_bain;
        $this->superficie = $hotel->superficie;
        $this->prix_min = $hotel->prix_min;
        $this->prix_max = $hotel->prix_max;
        $this->date_validite = date('Y-m-d', strtotime($hotel->annonce->date_validite));
        $this->types_lit = $hotel->annonce->references('types-de-lit')->pluck('id')->toArray();
        $this->commodites = $hotel->annonce->references('commodites-hebergement')->pluck('id')->toArray();
        $this->services = $hotel->annonce->references('services')->pluck('id')->toArray();
        $this->equipements_herbegement = $hotel->annonce->references('equipements-hebergement')->pluck('id')->toArray();
        $this->equipements_salle_bain = $hotel->annonce->references('equipements-salle-de-bain')->pluck('id')->toArray();
        $this->equipements_cuisine = $hotel->annonce->references('equipements-cuisine')->pluck('id')->toArray();
        $this->old_galerie = $hotel->annonce->galerie()->get();
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
            'nom' => 'required|string|min:3|max:255|unique:annonces,titre,' . $this->hotel->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,

            // 'entreprise_id' => 'required|exists:entreprises,id',
            // // 'nom' => 'required|string|min:3|max:255|unique:annonces,titre,id,entreprise_id', update
            // 'nom' => 'required|string|min:3|max:255|unique:annonces,titre'. $this->annonce->id .',id,entreprise_id'. $this->entreprise_id,
            'type' => 'nullable',
            'is_active' => 'required|boolean',
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
            // 'galerie.*' => 'image|max:5120',
            // 'galerie' => 'max:10',
            'date_validite' => 'required|date',
            // 'heure_validite' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'nom.unique' => 'Le nom est déjà pris',
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.exists' => 'L\'entreprise n\'existe pas',
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

    public function updatedIsActive()
    {
        // TODO : Mettre le controle de sorte qu'on puisse activer une annonce avec une date de validité inferieur à la date du jour
    }

    // public function updated

    public function update()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $date_validite = $this->date_validite . ' ' . $this->heure_validite;

            $this->hotel->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,
            ]);


            $this->hotel->update([
                'nombre_chambre' => $this->nombre_chambre,
                'nombre_personne' => $this->nombre_personne,
                'superficie' => $this->superficie,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
                'type' => $this->type_hebergement,
                'nombre_salles_bain' => $this->nombre_salles_bain,
            ]);

            if ($this->types_lit) {
                $this->hotel->annonce->removeReferences('types-de-lit');
                foreach ($this->types_lit as $value) {
                    $this->hotel->annonce->references()->attach(
                        $value,
                        [
                            'titre' => 'Types de lit',
                            'slug' => 'types-de-lit',
                        ]
                    );
                }
            }

            if ($this->commodites) {
                $this->hotel->annonce->removeReferences('commodites-hebergement');
                foreach ($this->commodites as $value) {
                    $this->hotel->annonce->references()->attach(
                        $value,
                        [
                            'titre' => 'Commodités',
                            'slug' => 'commodites-hebergement',
                        ]
                    );
                }
            }

            if ($this->services) {
                $this->hotel->annonce->removeReferences('services');
                foreach ($this->services as $value) {
                    $this->hotel->annonce->references()->attach(
                        $value,
                        [
                            'titre' => 'Services',
                            'slug' => 'services',
                        ]
                    );
                }
            }

            if ($this->equipements_herbegement) {
                $this->hotel->annonce->removeReferences('equipements-hebergement');
                foreach ($this->equipements_herbegement as $value) {
                    $this->hotel->annonce->references()->attach(
                        $value,
                        [
                            'titre' => 'Equipements hébergement',
                            'slug' => 'equipements-hebergement',
                        ]
                    );
                }
            }

            if ($this->equipements_salle_bain) {
                $this->hotel->annonce->removeReferences('equipements-salle-de-bain');
                foreach ($this->equipements_salle_bain as $value) {
                    $this->hotel->annonce->references()->attach(
                        $value,
                        [
                            'titre' => 'Equipements salle de bain',
                            'slug' => 'equipements-salle-de-bain',
                        ]
                    );
                }
            }

            if ($this->equipements_cuisine) {
                $this->hotel->annonce->removeReferences('equipements-cuisine');
                foreach ($this->equipements_cuisine as $value) {
                    $this->hotel->annonce->references()->attach(
                        $value,
                        [
                            'titre' => 'Equipements cuisine',
                            'slug' => 'equipements-cuisine',
                        ]
                    );
                }
            }

            if ($this->galerie) {
                $this->hotel->annonce->removeGalerie();
                foreach ($this->galerie as $image) {
                    $image->store('public/annonces');
                    $fichier = Fichier::create([
                        'nom' => $image->hashName(),
                        'chemin' => 'annonces/' . $image->hashName(),
                        'extension' => $image->extension(),
                    ]);

                    $this->hotel->annonce->galerie()->attach($fichier->id);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'hotel'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        $this->reset();
        $this->initialization();

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', __('L\'hotel a bien été modifiée avec succès'));

        return redirect()->route('annonces.index');
    }

    public function render()
    {
        return view('livewire.admin.hotel.edit');
    }
}
