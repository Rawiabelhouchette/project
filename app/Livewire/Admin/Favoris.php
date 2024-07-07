<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;


class Favoris extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $perPage = 1;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateFavoris($annonceId)
    {
        $favorite = \App\Models\Favoris::where('annonce_id', $annonceId)->where('user_id', auth()->user()->id)->first();
        if ($favorite) {
            $favorite->delete();
        } 
        // else {
        //     \App\Models\Favoris::create([
        //         'annonce_id' => $annonceId,
        //         'user_id' => auth()->user()->id
        //     ]);
        // }
    }

    public function render()
    {
        $search = $this->search;
        $user = User::find(auth()->user()->id);
        $annonces = $user->favorisAnnonces()->where(function ($query) use ($search) {
            $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%']);
        })
            ->paginate($this->perPage);

        return view('livewire.admin.favoris', compact('annonces'));
    }
}
