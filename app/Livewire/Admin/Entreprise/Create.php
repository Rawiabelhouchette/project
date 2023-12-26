<?php

namespace App\Livewire\Admin\Entreprise;

use App\Models\Entreprise;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Ville;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On; 

class Create extends Component
{
    public $nom = '';
    public $description = '';
    public $site_web = '';
    public $email = '';
    public $telephone = '';
    public $instagram = '';
    public $facebook = '';
    public $whatsapp = '';
    public $logo = '';
    public $longitude = '';
    public $latitude = '';
    public $pays_id = '';
    public $ville_id = '';
    public $quartier_id = '';
    public $nbr_planning = 1;
    public $pays;
    public $villes = [];
    public $quartiers = [];
    public $autreJour = true;
    
    public $plannings = [
        [
            'jour' => '',
            'heure_debut' => '',
            'heure_fin' => '',
        ]
    ];

    public function mount()
    {
        $this->pays = Pays::all();
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3|max:255|unique:entreprises,nom,id,quartier_id',
            // FIXME: Description does not work
            'description' => 'nullable|string|min:3|max:255',
            'site_web' => 'nullable|string|min:3|max:255',
            'email' => 'required|string|min:3|max:255',
            'telephone' => 'nullable|string|min:3|max:255',
            'instagram' => 'nullable|string|min:3|max:255',
            'facebook' => 'nullable|string|min:3|max:255',
            'whatsapp' => 'required|string|min:3|max:255',
            'logo' => 'nullable|string|min:3|max:255',
            'quartier_id' => 'required|integer|exists:quartiers,id',
            'longitude' => 'nullable|string|min:3|max:255',
            'latitude' => 'nullable|string|min:3|max:255',

        ];
    }

    public function updatedPaysId($pays_id)
    {
        $this->ville_id = '';
        $this->quartier_id = '';
        $this->villes = Ville::where('pays_id', $pays_id)->get();
    }
    
    public function updatedVilleId($ville_id)
    {
        $this->quartier_id = '';
        $this->quartiers = Quartier::where('ville_id', $ville_id)->get();
    }

    #[On('changerJour')] 
    public function changerJour($valeur)
    {
        $this->autreJour = $valeur;
    }

    public function addPlanning()
    {
        if (!$this->autreJour) return;

        if ($this->nbr_planning <= 7) {
            $this->nbr_planning++;
            $this->plannings[] = [
                'jour' => '',
                'heure_debut' => '',
                'heure_fin' => '',
            ];
        }
    }

    public function removePlanning($key)
    {
        unset($this->plannings[$key]);
    }

    
    #[On('setLocation')] 
    public function setLocation($location)
    {
        $this->longitude = (String) $location['lon'];
        $this->latitude = (String) $location['lat'];
    }

    public function store()
    {
        $validated = $this->validate();

        // check if date is not repeated 
        $jours = [];
        $jour_tmp = '';
        foreach ($this->plannings as $planning) {
            if (in_array($planning['jour'], $jours)) {
                $index = array_search($planning, $this->plannings) + 1;
                $jour_tmp = $planning['jour'];
                $this->dispatch('alert:modal', [
                    'message' => __('Jour ['. $jour_tmp .'] est déjà sélectionné'),
                ]);
                return;
            }
            $jours[] = $planning['jour'];
        }


        // Verifier si l'heure de debut est inferieur à l'heure de fin
        foreach ($this->plannings as $planning) {
            if ($planning['heure_debut'] > $planning['heure_fin']) {
                $index = array_search($planning, $this->plannings) + 1;
                $this->dispatch('alert:modal', [
                    'message' => __('Heure de fermeture ['. $index .'] doit être supérieur à heure de d\'ouverture'),
                ]);
                return;
            }
        }

        try {
            $entreprise = Entreprise::create($validated);
            foreach ($this->plannings as $planning) {
                $entreprise->heure_ouverture()->create($planning);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'entreprise'),
            ]);
            return;
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Entreprise ajoutée avec succès'),
        ]);

        // $this->dispatch('maker:reset');

        $this->reset();
        $this->pays = Pays::all();

    }

    public function render()
    {
        return view('livewire.admin.entreprise.create');
    }
}
