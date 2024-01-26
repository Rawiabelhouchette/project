<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use Livewire\Component;

class Favoris extends Component
{
    public $user;
    public $favoris;    

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->user = User::find(auth()->user()->id);
        $this->favoris = $this->user->favorisAnnonces()->paginate(10);
    }

    public function render()
    {
        return view('livewire.public.user.favoris');
    }
}
