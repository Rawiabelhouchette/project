<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Utils\AnnoncesUtils;
use Livewire\Component;
use Livewire\WithPagination;

class Annonce extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $perPage = 8;

    public $search = '';

    public $is_published;

    public $types;

    public $type;

    public function delete($id)
    {
        $annonce = User::find(auth()->user()->id)->annonces()->find($id);
        if ($annonce) {
            $annonce->annonceable->delete();
            $annonce->delete();
            $this->dispatch('swal:modal', [
                'icon' => 'success',
                'title' => __('Annonce supprimée avec succès'),
                'message' => __('L\'annonce a été supprimée avec succès.'),
            ]);
        }
    }

    public function render()
    {
        $this->types = AnnoncesUtils::getFilterAnnonceTypeList();
        $search = strtolower($this->search);
        $user = User::find(auth()->user()->id);
        $annonces = $user->annonces();

        if ($this->type) {
            $annonces->where('type', $this->type);
            $this->resetPage();
        }

        if ($this->is_published == '1') {
            $annonces->where('is_active', 1)
                ->where('date_validite', '>=', now());
            $this->resetPage();
        } elseif ($this->is_published == '0') {
            $annonces->where(function ($query) {
                $query->where('is_active', 0)
                    ->orWhere('date_validite', '<', now());
            });
            $this->resetPage();
        }

        if ($search) {
            $annonces->where(function ($query) use ($search) {
                $query->orWhereRaw('LOWER(titre) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(type) LIKE ?', ["%$search%"]);
            });
            $this->resetPage();
        }

        $annonces = $annonces->paginate($this->perPage);

        return view('livewire.admin.annonce', compact('annonces'));
    }
}
