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
        $search = $this->search;
        $user = User::find(auth()->user()->id);
        $annonces = $user->annonces()->paginate($this->perPage);

        return view('livewire.admin.annonce', compact('annonces'));
    }
}
