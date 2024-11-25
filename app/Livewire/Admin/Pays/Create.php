<?php

namespace App\Livewire\Admin\Pays;

use DB;
use Livewire\Component;
use App\Models\Pays;
use Illuminate\Support\Str;

class Create extends Component
{
    public $nom;
    public $code;
    public $indicatif;
    public $langue;
    public $isEdit = false;
    public $pays;

    public $libelle = 'Enregistrer un pays';
    public $buttonLibelle = 'Enregistrer';

    public function mount($paysId = null)
    {
        if ($paysId) {
            $this->loadPays($paysId);
        } else {
            $this->isEdit = false;
        }
    }

    protected $listeners = [
        'editPays' => 'editPays',
        'deletePays' => 'delete',
    ];

    public function editPays($paysId)
    {
        $this->loadPays($paysId);
        $this->isEdit = true;
        $this->libelle = 'Modifier un pays';
        $this->buttonLibelle = 'Modifier';
    }

    public function loadPays($paysId)
    {
        $this->isEdit = true;
        $this->pays = Pays::findOrFail($paysId);
        $this->nom = $this->pays->nom;
        $this->code = $this->pays->code;
        $this->indicatif = $this->pays->indicatif;
        $this->langue = $this->pays->langue;
    }

    public function exitEdit()
    {
        $this->isEdit = false;
        $this->libelle = 'Enregistrer un pays';
        $this->buttonLibelle = 'Enregistrer';
        $this->reset();
    }

    protected function rules()
    {
        $uniqueRule = $this->isEdit ? '' : '|unique:pays';
        return [
            'nom' => 'required|string|min:3|max:255' . $uniqueRule,
            'code' => 'required|string|min:2|max:255' . $uniqueRule,
            'indicatif' => 'required|string|min:3|max:255' . $uniqueRule,
            'langue' => 'required|string|max:255',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom du pays est obligatoire.',
        'nom.unique' => 'Le nom du pays existe déjà.',

        'code.required' => 'Le code du pays est obligatoire.',
        'code.unique' => 'Le code du pays existe déjà.',

        'indicatif.required' => 'L\'indicatif du pays est obligatoire.',
        'indicatif.unique' => 'L\'indicatif du pays existe déjà.',

        'langue.required' => 'La langue du pays est obligatoire.',
    ];

    public function store()
    {
        $validated = $this->validate();

        $validated['slug'] = Str::slug($validated['nom']);
        $validated['code'] = strtoupper($validated['code']);

        Pays::create($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Pays ajouté avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();

        $validated['slug'] = Str::slug($validated['nom']);
        $validated['code'] = strtoupper($validated['code']);

        $this->pays->update($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Pays modifié avec succès'),
        ]);

        return redirect()->route('pays.index');
    }


    public function delete($paysId)
    {
        DB::beginTransaction();

        try {
            $pays = Pays::findOrFail($paysId);
            $pays->villes->each(function ($ville) {
                $ville->quartiers->each(function ($quartier) {
                    $quartier->delete();
                });
                $ville->delete();
            });

            $pays->delete();

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

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Pays supprimé avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');
    }

    public function render()
    {
        return view('livewire.admin.pays.create');
    }
}
