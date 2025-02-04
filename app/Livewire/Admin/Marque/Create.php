<?php

namespace App\Livewire\Admin\Marque;

use DB;
use Livewire\Component;
use App\Models\Marque;
use Illuminate\Support\Str;

class Create extends Component
{
    public $marque;
    public $nom;
    public $isEdit = false;
    public $formIcon = 'save';

    public $libelle = 'Enregistrer une marque';
    public $buttonLibelle = 'Enregistrer';

    public function mount($marqueId = null)
    {
        if ($marqueId) {
            $this->loadMarque($marqueId);
        } else {
            $this->isEdit = false;
        }
    }

    protected $listeners = [
        'editMarque' => 'edit',
        'deleteMarque' => 'delete',
    ];

    public function edit($marqueId)
    {
        $this->loadMarque($marqueId);
        $this->isEdit = true;
        $this->libelle = 'Modifier une marque';
        $this->buttonLibelle = 'Modifier';
        $this->formIcon = 'edit';
    }

    public function loadMarque($marqueId)
    {
        $this->isEdit = true;
        $this->marque = Marque::findOrFail($marqueId);
        $this->nom = $this->marque->nom;
    }

    public function exitEdit()
    {
        $this->isEdit = false;
        $this->libelle = 'Enregistrer une marque';
        $this->buttonLibelle = 'Enregistrer';
        $this->reset();
    }

    protected function rules()
    {
        if ($this->isEdit) {
            return [
                'nom' => 'required|string|min:3|unique:marques,nom,' . $this->marque->id,
            ];
        }
        return [
            'nom' => 'required',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom de la marque est obligatoire.',
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
                $marque = Marque::where('nom', $valeur)->first();
                if ($marque) {
                    $existingValues .= $valeur . ', ';
                    continue;
                }
                $hasOneNewValue = true;
                Marque::create([
                    'nom' => $valeur,
                ]);
            }
        } catch (\Throwable $th) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Une erreur est survenue lors de l\'enregistrement de la marque'),
            ]);
            return;
        }

        if (!$hasOneValideValue) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Veuillez saisir une valeur valide.'),
            ]);
            return;
        }

        if (!$hasOneNewValue) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Les valeurs suivantes existent déjà : ' . rtrim($existingValues, ', ')),
            ]);
            return;
        }

        $message = 'Marque(s) ajoutée(s) avec succès';
        if ($existingValues) {
            $message .= ' <br>Les valeurs suivantes existent déjà : ' . rtrim($existingValues, ', ');
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __($message),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();

        $this->marque->update($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Marque modifiée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->exitEdit();
    }


    public function delete($marqueId)
    {
        DB::beginTransaction();

        try {
            $marque = Marque::findOrFail($marqueId);
            $marque->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Erreur'),
                'message' => __('Une erreur s\'est produite lors de la suppression du marque'),
            ]);
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Marque supprimée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');
    }

    public function render()
    {
        return view('livewire.admin.marque.create');
    }
}
