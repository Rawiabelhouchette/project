<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;


class Annonce extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $perPage = 9;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        session()->flash('success', 'L\'annonce a bien été ajoutée');

        $search = $this->search;
        $user = User::find(auth()->user()->id);
        $annonces = $user->annonces()->where(function ($query) use ($search) {
            $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(type) LIKE ?', ['%' . strtolower($search) . '%']);
        })->paginate($this->perPage);

        return view('livewire.admin.annonce', compact('annonces'));
    }
}
