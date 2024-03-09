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

    public function login()
    {
        $validated = $this->validate([
            'email' => 'required|min:4',
            'password' => 'required|min:4',
        ]);
        
        $request = new Request($validated);
        
        $login = AuthenticationController::loginService($request);
        if (!$login->status) {
            $this->error = true;
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
