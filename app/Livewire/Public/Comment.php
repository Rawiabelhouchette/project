<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use Livewire\Component;

class Comment extends Component
{
    public $annonce_id;
    public $annonce;
    public $comment;
    public $note;
    public $perPage = 2;

    protected $listeners = ['updateNoteValue' => 'setNoteValue'];

    public function mount($annonce)
    {
        $this->annonce = $annonce;
        $this->annonce_id = $annonce->id;
    }

    public function rules()
    {
        return [
            'note' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'note.required' => 'Le champ note est obligatoire',
            'note.integer' => 'La note doit être un nombre entier',
            'note.min' => 'La note doit être comprise entre 1 et 5',
            'comment.required' => 'Le champ commentaire est obligatoire',
            'comment.min' => 'Le champ commentaire doit contenir au moins 5 caractères'
        ];
    }

    public function setNoteValue($value)
    {
        $this->note = $value;
    }

    public function loadMore($id, $perPage)
    {
        $this->perPage = $perPage + 1;
        $this->annonce = Annonce::find($id);
    }

    public function addComment()
    {
        $this->validate();

        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->annonce->commentaires()->create([
            'user_id' => auth()->id(),
            'note' => $this->note,
            'contenu' => $this->comment
        ]);

        // session()->flash('success', 'Commentaire ajouté avec succès');

        $this->comment = '';
    }

    public function render()
    {
        $count = $this->annonce->commentaires()->count();

        $this->dispatch('update:comment-value', [
            'value' => $count,
        ]);

        return view('livewire.public.comment', [
            'commentaires' => $this->annonce->commentaires()->latest()->paginate($this->perPage),
            'count' => $count
        ]);
    }
}
