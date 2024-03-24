<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use Livewire\Component;
use Livewire\Attributes\On; 

class Comment extends Component
{
    public $id;
    public $count = 0;
    protected $comments;
    public $comment;
    public $note;
    protected $perPage = 2;

    // protected $listeners = ['updateNoteValue' => 'setNoteValue'];

    public function mount($annonce_id)
    {
        $this->count = Annonce::find($annonce_id)->commentaires()->count();
        $this->id = $annonce_id;
        $annonce = Annonce::find($annonce_id);
        $this->comments = $annonce->commentaires();
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

    #[On('updateNoteValue')]
    public function setNoteValue($value)
    {
        // dd("++++++++++++++++");
        $this->note = $value;
        // return false; // to avoid the re-render of the component
    }

    public function loadMore($id)
    {
        $this->count = Annonce::find($id)->commentaires()->count();
        $this->perPage = $this->perPage + 1;
        $annonce = Annonce::find($id);
        $this->comments = $annonce->commentaires();
    }

    public function addComment()
    {
        $this->validate();
        dd($this->note);

        $this->annonce->commentaires()->create([
            'user_id' => auth()->id(),
            'note' => $this->note,
            'contenu' => $this->comment
        ]);

        $this->comment = '';
    }
    
    public function render()
    {
        $this->comments = $this->comments->latest()->paginate($this->perPage);
        return view('livewire.public.comment', [
            'comments' => $this->comments
        ]);
    }
}
