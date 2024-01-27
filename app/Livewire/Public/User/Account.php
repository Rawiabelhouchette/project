<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use Livewire\Component;

class Account extends Component
{
    public $user;
    public $isEdit = false;
    public $editInfo = false;
    public $editPass = false;
    public $hasPassword = false;

    public $username;
    public $nom;
    public $prenom;
    public $email;
    public $password;
    public $password_confirmation;
    public $password_old;


    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->user = User::find(auth()->user()->id);
        $this->initialize();
    }

    public function initialize()
    {
        $this->username = $this->user->username;
        $this->nom = $this->user->nom;
        $this->prenom = $this->user->prenom;
        $this->email = $this->user->email;
    }

    public function rules()
    {
        $validate = [
            'username' => 'required|min:3|max:255|unique:users,username,' . $this->user->id,
            'nom' => 'required|min:3|max:255',
            'prenom' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email,' . $this->user->id,
        ];


        if ($this->hasPassword) {
            $validate['password'] = 'required|min:4|max:255|confirmed';
            $validate['password_confirmation'] = 'required|min:4|max:255';
        }

        return $validate;
    }


    public function messages()
    {
        return [
            'username.required' => 'Le nom d\'utilisateur est obligatoire',
            'username.min' => 'Le nom d\'utilisateur doit contenir au moins 3 caractères',
            'username.max' => 'Le nom d\'utilisateur ne doit pas dépasser 255 caractères',
            'username.unique' => 'Le nom d\'utilisateur est déjà utilisé',
            'nom.required' => 'Le nom est obligatoire',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'prenom.required' => 'Le prénom est obligatoire',
            'prenom.min' => 'Le prénom doit contenir au moins 3 caractères',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'adresse email est obligatoire',
            'email.email' => 'L\'adresse email doit être valide',
            'email.min' => 'L\'adresse email doit contenir au moins 3 caractères',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères',
            'email.unique' => 'L\'adresse email est déjà utilisée',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères',
            'password.max' => 'Le mot de passe ne doit pas dépasser 255 caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
            'password_confirmation.min' => 'Le mot de passe doit contenir au moins 4 caractères',
            'password_confirmation.max' => 'Le mot de passe ne doit pas dépasser 255 caractères',
        ];
    }

    // I want the three input to be 

    public function updatedPassword()
    {
        if ($this->password != '') {
            $this->hasPassword = true;
        } else {
            $this->hasPassword = false;
        }
    }



    public function editInformation()
    {
        $this->editInfo = true;
    }

    public function editPassword()
    {
        $this->editPass = true;
    }

    public function cancel()
    {
        $this->editInfo = false;
        $this->editPass = false;
        $this->initialize();
    }

    public function update()
    {
        // dd($this->validate());

        $this->user->update([
            'username' => $this->username,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
        ]);

        $this->isEdit = false;

        if ($this->password) {
            $this->user->update([
                'password' => bcrypt($this->password),
            ]);
        }

        session()->flash('success', 'Votre compte a été mis à jour avec succès');
        return;
    }

    public function render()
    {
        return view('livewire.public.user.account');
    }
}
