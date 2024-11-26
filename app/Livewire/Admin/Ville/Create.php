<?php

namespace App\Livewire\Admin\Ville;

use App\Models\Pays;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\Ville;
use Illuminate\Support\Str;

class Create extends Component
{
    public $nom;
    public $isEdit = false;
    public $pays;
    public $ville;
    public $pays_id;
    public $libelle = 'Enregistrer une ville';
    public $buttonLibelle = 'Enregistrer';

    public function mount($villeId = null)
    {
        $this->pays = Pays::all();
        if ($villeId) {
            $this->loadVille($villeId);
        } else {
            $this->isEdit = false;
        }
    }

    protected $listeners = [
        'editVille' => 'edit',
        'deleteVille' => 'delete',
    ];

    public function edit($villeId)
    {
        $this->loadVille($villeId);
        $this->isEdit = true;
        $this->libelle = 'Modifier une ville';
        $this->buttonLibelle = 'Modifier';
    }

    public function loadVille($villeId)
    {
        $this->isEdit = true;
        $this->ville = Ville::findOrFail($villeId);
        $this->nom = $this->ville->nom;
        $this->pays_id = $this->ville->pays_id;
    }

    public function exitEdit()
    {
        $this->isEdit = false;
        $this->libelle = 'Enregistrer une ville';
        $this->buttonLibelle = 'Enregistrer';
        $this->reset();
        $this->pays = Pays::all();
    }

    protected function rules()
    {
        if ($this->isEdit) {
            return [
                'nom' => 'required|string|min:3|unique:villes,nom,' . $this->ville->id,
                'pays_id' => 'required|exists:pays,id',
            ];
        }
        return [
            'nom' => 'required|string|min:3|max:255',
            'pays_id' => 'required|exists:pays,id',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom est obligatoire',
        'nom.min' => 'Le nom doit contenir au moins 3 caractères',
        'nom.unique' => 'Le nom existe déjà',
        'pays_id.required' => 'Le pays est obligatoire',
        'pays_id.exists' => 'Le pays n\'existe pas',
    ];

    public function store()
    {
        if ($this->isEdit) {
            $this->update();
            return;
        }

        $validated = $this->validate();

        // check if the ville already exists
        $ville = Ville::where('nom', $this->nom)->where('pays_id', $this->pays_id)->first();

        if ($ville) {
            throw ValidationException::withMessages([
                'nom' => __('La ville de ce pays existe déjà'),
            ]);
        }

        Ville::create($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Ville ajouté avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();

        $this->pays = Pays::all();
    }

    public function update()
    {
        $validated = $this->validate();

        // check if the ville already exists
        $ville = Ville::where('nom', $this->nom)
            ->where('pays_id', $this->pays_id)
            ->where('id', '!=', $this->ville->id)
            ->first();

        if ($ville) {
            throw ValidationException::withMessages([
                'nom' => __('La ville de ce pays existe déjà'),
            ]);
        }

        $this->ville->update($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Ville modifié avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->exitEdit();
    }


    public function delete($villeId)
    {
        DB::beginTransaction();

        try {
            $ville = Ville::findOrFail($villeId);
            $ville->quartiers->each(function ($quartier) {
                $quartier->delete();
            });
            $ville->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Erreur'),
                'message' => __('Une erreur s\'est produite lors de la suppression du pays'),
            ]);
        }

        $this->exitEdit();

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Ville supprimée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');
    }

    public function render()
    {
        return view('livewire.admin.ville.create');
    }
}
