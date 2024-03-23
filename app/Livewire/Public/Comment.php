<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Comment extends Component
{
    public $annonce;
    public $comment;

     public function mount($annonce)
    {
        $this->annonce = $annonce;
    }

    public function render()
    {
        return view('livewire.public.comment');
    }
}
