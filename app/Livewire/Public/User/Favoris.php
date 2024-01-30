<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use App\Utils\CustomSession;
use Livewire\Component;

class Favoris extends Component
{
    public $user;
    private $annonces; 
    private $perPage = 2;   
    public $search = '';

    public function updatedSearch($value)
    {
        $session = new CustomSession();
        $session->favorite_search = $value;
        $session->save();
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
        // I dont want to run render
    }

    public function render()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }
        $session = new CustomSession();
        $this->search = $session->favorite_search;
        $search = $this->search;

        $this->user = User::find(auth()->user()->id);
        $annonces = $this->user->favorisAnnonces()->where(function ($query) use ($search) {
            $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%']);
        })   
        ->paginate($this->perPage);
        $annonces->withPath($session->favorite_link);


        // $annonces = $this->annonces;
        return view('livewire.public.user.favoris', compact('annonces'));
    }
}
