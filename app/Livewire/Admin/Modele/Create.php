<?php

namespace App\Livewire\Admin\Modele;

use App\Models\Marque;
use App\Models\Modele;
use DB;
use Livewire\Component;

class Create extends Component
{
    public $nom;

    public $marque_id;

    public $isEdit = false;

    public $modele;

    public $formIcon = 'save';

    public $marques;

    public $libelle = 'Enregistrer un modèle';

    public $buttonLibelle = 'Enregistrer';

    public function mount($modeleId = null)
    {
        $this->marques = Marque::all();

        if ($modeleId) {
            $this->loadModele($modeleId);
        } else {
            $this->isEdit = false;
        }
    }

    protected $listeners = [
        'editModele' => 'edit',
        'deleteModele' => 'delete',
    ];

    public function edit($modeleId)
    {
        $this->loadModele($modeleId);
        $this->isEdit = true;
        $this->libelle = 'Modifier un modèle';
        $this->buttonLibelle = 'Modifier';
        $this->formIcon = 'edit';
    }

    public function loadModele($modeleId)
    {
        $this->isEdit = true;
        $this->modele = Modele::findOrFail($modeleId);
        $this->nom = $this->modele->nom;
        $this->marque_id = $this->modele->marque_id;
    }

    public function exitEdit()
    {
        $this->isEdit = false;
        $this->libelle = 'Enregistrer un modèle';
        $this->buttonLibelle = 'Enregistrer';
        $this->reset();
        $this->marques = Marque::all();
    }

    protected function rules()
    {
        if ($this->isEdit) {
            return [
                'nom' => 'required|string|min:3|unique:modeles,nom,'.$this->modele->id,
                'marque_id' => 'required|exists:marques,id',
            ];
        }

        return [
            'nom' => 'required',
            'marque_id' => 'required|exists:marques,id',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom du modèle est obligatoire.',

        'marque_id.required' => 'La marque est obligatoire.',
        'marque_id.exists' => 'La marque sélectionnée n\'existe pas.',
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

        try {
            // les valeurs sont stockées séparément par des virgules
            $valeurs = array_filter(array_map('trim', explode(',', $this->nom)));

            foreach ($valeurs as $valeur) {
                $hasOneValideValue = true;
                $modele = Modele::where('nom', $valeur)->where('marque_id', $this->marque_id)->first();
                if ($modele) {
                    $existingValues .= $valeur.', ';

                    continue;
                }
                $hasOneNewValue = true;
                Modele::create([
                    'nom' => $valeur,
                    'marque_id' => $this->marque_id,
                ]);
            }
        } catch (\Throwable $th) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Une erreur est survenue lors de l\'enregistrement du modèle'),
            ]);

            return;
        }

        if (! $hasOneValideValue) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Veuillez saisir une valeur valide.'),
            ]);

            return;
        }

        if (! $hasOneNewValue) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Les valeurs suivantes existent déjà pour la marque sélectionnée : '.rtrim($existingValues, ', ')),
            ]);

            return;
        }

        $message = 'Modèle(s) ajouté(s) avec succès';
        if ($existingValues) {
            $message .= ' <br>Les valeurs suivantes existent déjà pour la marque sélectionnée : '.rtrim($existingValues, ', ');
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __($message),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();

        $this->marques = Marque::all();
    }

    public function update()
    {
        $validated = $this->validate();

        $existingModele = Modele::where('nom', $this->nom)
            ->where('marque_id', $this->marque_id)
            ->where('id', '!=', $this->modele->id)
            ->first();

        if ($existingModele) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Un modèle avec ce nom existe déjà pour la marque sélectionnée.'),
            ]);

            return;
        }

        $this->modele->update($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Modèle modifié avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->exitEdit();
    }

    public function delete($modeleId)
    {
        DB::beginTransaction();

        try {
            $modele = Modele::findOrFail($modeleId);
            $modele->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Erreur'),
                'message' => __('Une erreur s\'est produite lors de la suppression du modèle'),
            ]);
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Modèle supprimé avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');
    }

    public function render()
    {
        return view('livewire.admin.modele.create');
    }
}
