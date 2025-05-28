<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Commentaire;
use Livewire\Component;

class Comment extends Component
{
    public $annonce_id;

    public $annonce;

    public $comment;

    public $note;

    public $perPage = 1;

    public $message = [];

    public $hasMessage = false;

    protected $listeners = ['updateNoteValue' => 'setNoteValue'];

    public function mount($annonce)
    {
        $this->annonce_id = $annonce->id;
        $this->annonce = $annonce;
    }

    public function rules()
    {
        return [
            'note' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'note.required' => 'Le champ note est obligatoire',
            'note.integer' => 'La note doit être un nombre entier',
            'note.min' => 'La note doit être comprise entre 1 et 5',
            'comment.required' => 'Le champ commentaire est obligatoire',
            'comment.min' => 'Le champ commentaire doit contenir au moins 5 caractères',
        ];
    }

    public function setNoteValue($value)
    {
        $this->hasMessage = false;
        $this->note = $value;
    }

    public function loadMore($id, $perPage)
    {
        $this->hasMessage = false;
        $this->perPage = $perPage + 5;
    }

    public function addComment()
    {
        $this->validate();

        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->hasMessage = true;

        try {
            Commentaire::create([
                'annonce_id' => $this->annonce_id,
                'user_id' => auth()->id(),
                'note' => $this->note,
                'contenu' => $this->comment,
            ]);
        } catch (\Exception $e) {
            $this->message = (object) [
                'type' => 'danger',
                'message' => 'Une erreur est survenue lors de l\'ajout du commentaire',
            ];

            return;
        }
        $this->message = (object) [
            'type' => 'success',
            'message' => 'Commentaire ajouté avec succès',
        ];

        $this->comment = '';
    }

    public function render()
    {
        $count = $this->annonce->getCommentCount();

        $this->dispatch('update:comment-value', [
            'value' => $count,
            'note' => $this->annonce->getNote(),
        ]);

        $commentaires = Commentaire::with('auteur')->where('annonce_id', $this->annonce_id)->paginate($this->perPage);

        return view('livewire.public.comment', [
            'commentaires' => $commentaires,
            'count' => $count,
        ]);
    }
}