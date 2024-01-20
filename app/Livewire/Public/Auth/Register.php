<?php

namespace App\Livewire\Public\Auth;

use App\Http\Controllers\AuthenticationController;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Register extends Component
{
    public $error = false;
    public $message = '';

    public $registration = 'Usager';
    public $nom;
    public $prenom;
    public $sexe;
    public $telephone;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;
    public $remember = false;

    public function rules()
    {
        return [
            'nom' => 'required',
            'prenom' => 'required',
            // 'sexe' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',
            'sexe.required' => 'Le sexe est obligatoire',
            'username.required' => 'Le nom d\'utilisateur est obligatoire',
            'password.required' => 'Le mot de passe est obligatoire',
            'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire',
            'password_confirmation.same' => 'Les mots de passe ne sont pas identiques',
        ];
    }

    public function register()
    {
        $this->validate();


        // Verifier si le username existe deja
        $user = User::where('username', $this->username)->first();
        if ($user) {
            $this->error = true;
            $this->message = 'Veuiilez choisir un autre nom d\'utilisateur';
            $this->username = '';
            $this->password = '';
            $this->password_confirmation = '';
            return;
        }

        // Verifier si l'email existe deja
        if ($this->email != '') {
            $user = User::where('email', $this->email)->first();
            if ($user) {
                $this->error = true;
                $this->message = 'Email existe deja';
                $this->email = '';
                $this->password = '';
                $this->password_confirmation = '';
                return;
            }
        }

        // Verifier si la combinaison nom et prenom existe deja
        // $user = User::where('nom', $this->nom)->where('prenom', $this->prenom)->first();
        // if ($user) {
        //     $this->error = true;
        //     $this->message = 'Ce nom et prenom existe deja';

        //     return;
        // }

        DB::beginTransaction();

        try {
            $user = User::create([
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'email' => $this->email,
                'username' => $this->username,
                'password' => $this->password,
            ]);

            $user->assignRole($this->registration);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->error = true;
            $this->message = 'Erreur lors de l\'enregistrement';
            return;
        }

        $request = new Request([
            'email' => $this->username,
            'password' => $this->password,
        ]);

        $login = AuthenticationController::loginService($request);
        if (!$login->status) {
            $this->error = true;
            $this->message = $login->message;
            $this->password = '';
            return;
        }

        $this->dispatch('page:reload', []);
    }

    public function render()
    {
        return view('livewire.public.auth.register');
    }
}
