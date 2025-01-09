<?php

namespace App\Livewire\Public\Auth;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $error = false;
    public $message = '';
    public $email;
    public $password;
    public $remember = false;
    public $gRecaptchaResponse;

    public function login()
    {
        // dd($request->all());
        $validated = $this->validate([
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
            'g-recaptcha-response' => $this->gRecaptchaResponse,
        ], [
            'email' => 'required|min:4',
            'password' => 'required|min:4',
            'remember' => 'boolean',
            'g-recaptcha-response' => 'recaptcha',
            // recaptchaFieldName() => recaptchaRuleName()
        ], [
            'email.required' => 'Le champ email est obligatoire',
            'email.min' => 'Le champ email doit contenir au moins 4 caractères',
            'password.required' => 'Le champ mot de passe est obligatoire',
            'password.min' => 'Le champ mot de passe doit contenir au moins 4 caractères',
        ]);

        //         $validator = Validator::make($this->all(), [
//     'email' => 'required|min:4',
//     'password' => 'required|min:4',
//     'remember' => 'boolean',
//     'g-recaptcha-response' => 'recaptcha',
//     // recaptchaFieldName() => recaptchaRuleName()
// ], [
//     'email.required' => 'Le champ email est obligatoire',
//     'email.min' => 'Le champ email doit contenir au moins 4 caractères',
//     'password.required' => 'Le champ mot de passe est obligatoire',
//     'password.min' => 'Le champ mot de passe doit contenir au moins 4 caractères',
// ]);

        // if ($validator->fails()) {
//     $this->dispatch('swal:modal', [
//         'icon' => 'error',
//         'title' => __('Opération échouée'),
//         'message' => __('Veuillez corriger les erreurs suivantes : ') . implode(', ', $validator->errors()->all()),
//     ]);
//     return;
// }

        // $validated = $validator->validated();

        $request = new Request($validated);

        $login = AuthenticationController::loginService($request);
        if (!$login->status) {
            $this->error = true;
            $this->password = '';
            $this->message = $login->message;
            return;
        }

        // if (auth()->user()->hasRole('Administrateur')) {
        //     return redirect()->route('home');
        // }

        $this->dispatch('page:reload', []);
    }


    public function render()
    {
        return view('livewire.public.auth.login');
    }
}
