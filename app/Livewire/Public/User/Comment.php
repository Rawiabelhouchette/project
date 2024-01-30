<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use Livewire\Component;

class Comment extends Component
{
    public $user;
    private $perPage = 1;   

    public function mount()
    {

    }
    
    public function render()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->user = User::find(auth()->user()->id);
        $annonces = $this->user->commentaires()->paginate($this->perPage);
        // dd($annonces);
        return view('livewire.public.user.comment', compact('annonces'));
    }
}
