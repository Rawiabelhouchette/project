<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use App\Utils\CustomSession;
use Livewire\Component;

class Comment extends Component
{
    public $user;
    private $perPage = 1;   
    public $search = '';
    private $annonces;

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->user = User::find(auth()->user()->id);
        $this->annonces = $this->user->commentaires()->paginate($this->perPage);
    }

    public function updatedSearch($value)
    {
        $session = new CustomSession();
        $annonces = $this->user->commentaires();
        $annonces = $annonces->where(function ($query) use ($value) {
            $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($value) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($value) . '%']);
        });   
        $this->annonces = $annonces->paginate($this->perPage);
        $this->annonces->withPath($session->comment_link);
        $session->comment_search = $value;
        $session->save();
    }
    
    public function render()
    {
        $session = new CustomSession();
        $this->search = $session->comment_search;
        $annonces = $this->annonces;
        return view('livewire.public.user.comment', compact('annonces'));
    }
}
