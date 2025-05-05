<?php

namespace App\Livewire\Admin\Reference;

use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\References;
use Livewire\Component;

class Add extends Component
{
    public $id = null;

    public $type = '';

    public $nom = '';

    public $valeur = '';

    public $libelle = 'Créer une référence';

    public $buttonLibelle = 'Enregistrer';

    public $formIcon = 'save';

    public $isEdit = false;

    public $typeList = [];

    public $nomList = [];

    public function mount()
    {
        $this->typeList = References::getList();
    }

    protected $listeners = [
        'editReference' => 'editReference',
        'deleteReference' => 'deleteReference',
    ];

    public function updatedType($value)
    {
        $this->nom = '';
        $this->nomList = Reference::where('type', $value)->pluck('nom')->toArray();
    }

    public function editReference(ReferenceValeur $ref)
    {
        $this->libelle = 'Modifier une référence';
        $this->buttonLibelle = 'Modifier';

        $this->id = $ref->id;
        $this->type = $ref->reference->type;

        $this->nom = $ref->reference->nom;
        $this->typeList = [$ref->reference->type];
        $this->nomList = Reference::where('type', $ref->reference->type)->pluck('nom')->toArray();

        $this->valeur = $ref->valeur;

        $this->isEdit = true;

        $this->formIcon = 'edit';
    }

    public function deleteReference(ReferenceValeur $ref)
    {
        $reference = ReferenceValeur::find($ref->id);
        $reference->annonceReferences()->delete();
        $reference->delete();

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Référence supprimée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');
    }

    protected $rules = [
        'type' => 'required',
        'nom' => 'required',
        'valeur' => 'required',
    ];

    public function store()
    {
        $this->validate();

        $reference = Reference::where('type', $this->type)->where('nom', $this->nom)->first();
        if (! $reference) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Cette combinaison type/nom n\'existe pas.'),
            ]);
        }

        if ($this->isEdit) {
            $referenceValeur = ReferenceValeur::where('valeur', $this->valeur)->where('reference_id', $reference->id)->first();
            if ($referenceValeur) {
                $this->dispatch('swal:modal', [
                    'icon' => 'error',
                    'title' => __('Opération échouée'),
                    'message' => __('Cette référence existe déjà.'),
                ]);

                return;
            }

            $ref = ReferenceValeur::find($this->id);
            $validated = [
                'reference_id' => $reference->id,
                'valeur' => $this->valeur,
            ];
            $this->update($ref, $validated);
            $this->typeList = References::getList();

            return;
        }

        $existingValues = '';
        $hasOneNewValue = false;
        $hasOneValideValue = false;

        try {
            // les valeurs sont stockées séparément par des virgules
            $valeurs = array_filter(array_map('trim', explode(',', $this->valeur)));

            foreach ($valeurs as $valeur) {
                $hasOneValideValue = true;
                $referenceValeur = ReferenceValeur::where('valeur', $valeur)->where('reference_id', $reference->id)->first();
                if ($referenceValeur) {
                    $existingValues .= $valeur.', ';

                    continue;
                }
                $hasOneNewValue = true;
                ReferenceValeur::create([
                    'reference_id' => $reference->id,
                    'valeur' => $valeur,
                ]);
            }
        } catch (\Throwable $th) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('Une erreur est survenue lors de l\'enregistrement de la référence'),
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
                'message' => __('Les valeurs suivantes existent déjà : '.rtrim($existingValues, ', ')),
            ]);

            return;
        }

        $message = 'Référence(s) ajoutée(s) avec succès';
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

        $this->typeList = References::getList();

    }

    public function update(ReferenceValeur $ref, $validated)
    {
        $ref->update($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Référence modifiée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();
    }

    public function exitEdit()
    {
        $this->isEdit = false;
        $this->libelle = 'Enregistrer une référence';
        $this->buttonLibelle = 'Enregistrer';
        $this->reset();
        $this->typeList = References::getList();
    }

    public function render()
    {
        return view('livewire.admin.reference.add');
    }
}
