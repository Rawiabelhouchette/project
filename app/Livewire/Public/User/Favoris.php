<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use Livewire\Component;

class Favoris extends Component
{
    public $user;
    private $annonces; 
    private $perPage = 2;   

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->user = User::find(auth()->user()->id);
        $this->annonces = $this->user->favorisAnnonces()->paginate($this->perPage);
    }

    public function updateFavoris($annonceId)
    {
        $favorite = \App\Models\Favoris::where('annonce_id', $annonceId)->where('user_id', auth()->user()->id)->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            \App\Models\Favoris::create([
                'annonce_id' => $annonceId,
                'user_id' => auth()->user()->id
            ]);
        }

        $this->annonces = $this->user->favorisAnnonces()->paginate($this->perPage);
    }

    public function render()
    {
        $annonces = $this->annonces;
        return view('livewire.public.user.favoris', compact('annonces'));
    }
}
