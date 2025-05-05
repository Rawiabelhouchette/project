<?php

namespace App\Livewire\Admin\Quartier;

use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Ville;
use DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $nom;

    public $isEdit = false;

    public $pays;

    public $pays_id;

    public $villes;

    public $ville_id;

    public $quartier;

    public $libelle = 'Enregistrer un quartier';

    public $buttonLibelle = 'Enregistrer';

    public $formIcon = 'save';

    public function mount($quartierId = null)
    {
        if ($quartierId) {
            $this->loadQuartier($quartierId);
        } else {
            $this->isEdit = false;
            $this->pays = Pays::orderBy('nom')->get();
            $this->villes = [];
        }
    }

    protected $listeners = [
        'editQuartier' => 'edit',
        'deleteQuartier' => 'delete',
    ];

    // load the ville on pays_id change
    public function updatedPaysId($value)
    {
        $this->villes = Ville::where('pays_id', $value)->get();
    }

    public function edit($quartierId)
    {
        $this->loadQuartier($quartierId);
        $this->isEdit = true;
        $this->libelle = 'Modifier un quartier';
        $this->buttonLibelle = 'Modifier';
        $this->formIcon = 'edit';
    }

    public function loadQuartier($quartierId)
    {
        $this->isEdit = true;
        $this->quartier = Quartier::findOrFail($quartierId);
        $this->nom = $this->quartier->nom;
        $this->ville_id = $this->quartier->ville_id;
        $this->pays_id = $this->quartier->ville->pays_id;
        $this->villes = Ville::where('id', $this->ville_id)->get();
        $this->pays = Pays::where('id', $this->pays_id)->get();
    }

    public function exitEdit()
    {
        $this->isEdit = false;
        $this->libelle = 'Enregistrer un quartier';
        $this->buttonLibelle = 'Enregistrer';
        $this->reset();
        $this->pays = Pays::orderBy('nom')->get();
    }

    protected function rules()
    {
        if ($this->isEdit) {
            return [
                'nom' => 'required|string|min:3|unique:quartiers,nom,'.$this->quartier->id.',id,ville_id,'.$this->ville_id,
                'ville_id' => 'required|integer|exists:villes,id',
            ];
        }

        return [
            'nom' => 'required|string|min:3|unique:quartiers,nom,id,ville_id',
            'ville_id' => 'required|integer|exists:villes,id',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom du quartier est obligatoire',
        'nom.string' => 'Le nom du quartier doit être une chaine de caractères',
        'nom.min' => 'Le nom du quartier doit avoir au moins :min caractères',
        'nom.unique' => 'Le nom du quartier existe déjà',
        'ville_id.required' => 'La ville est obligatoire',
        'ville_id.integer' => 'La ville doit être un entier',
        'ville_id.exists' => 'La ville n\'existe pas',
    ];

    public function store()
    {
        if ($this->isEdit) {
            $this->update();

            return;
        }

        $this->validate();

        $existingValues = '';
        $hasOneNewValue = false;
        $hasOneValideValue = false;

        // les valeurs sont stockées séparément par des virgules
        $noms = array_filter(array_map('trim', explode(',', $this->nom)));

        foreach ($noms as $nom) {
            $hasOneValideValue = true;
            $quartier = Quartier::where('nom', $nom)->where('ville_id', $this->ville_id)->first();
            if ($quartier) {
                $existingValues .= $nom.', ';

                continue;
            }

            $hasOneNewValue = true;
            Quartier::create([
                'nom' => $nom,
                'ville_id' => $this->ville_id,
            ]);
        }

        if (! $hasOneValideValue) {
            throw ValidationException::withMessages([
                'nom' => __('Veuillez saisir une valeur valide.'),
            ]);
        }

        if (! $hasOneNewValue) {
            throw ValidationException::withMessages([
                'nom' => __('Les valeurs suivantes existent déjà : '.rtrim($existingValues, ', ')),
            ]);
        }

        $message = 'Quartier(s) ajouté(s) avec succès';
        if ($existingValues) {
            $message .= ' <br>Les valeurs suivantes existent déjà : '.rtrim($existingValues, ', ');
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __($message),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();

        $this->pays = Pays::orderBy('nom')->get();
        $this->villes = [];
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

        $this->villes = Ville::all();
    }

    public function delete($quartierId)
    {
        DB::beginTransaction();

        try {
            $ville = Ville::findOrFail($quartierId);
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
        return view('livewire.admin.quartier.create');
    }
}
