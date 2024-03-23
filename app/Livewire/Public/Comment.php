<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Comment extends Component
{
    public $annonce;
    public $comment;
    public $note;

    protected $listeners = ['updateNoteValue' => 'setNoteValue'];

    public function mount($annonce)
    {
        $this->annonce = $annonce;
    }

    public function setNoteValue($value)
    {
        $this->note = $value;
    }

    // Add comment
    public function addComment()
    {
        $this->validate(
            [
                'note' => 'required|integer|min:1|max:5',
                'comment' => 'required|min:5'
            ],
            [
                'note.required' => 'Le champ note est obligatoire',
                'note.integer' => 'La note doit être un nombre entier',
                'note.min' => 'La note doit être comprise entre 1 et 5',
                'comment.required' => 'Le champ commentaire est obligatoire',
                'comment.min' => 'Le champ commentaire doit contenir au moins 5 caractères'
                ]
            );
            dd($this->note, $this->comment);


        $this->annonce->comments()->create([
            'user_id' => auth()->id(),
            'note' => $this->note,
            'comment' => $this->comment
        ]);

        $this->comment = '';
    }
    public function render()
    {
        return view('livewire.public.comment');
    }
}
