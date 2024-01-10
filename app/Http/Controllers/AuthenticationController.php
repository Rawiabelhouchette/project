<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{

    public static function loginService($request) : object
    {
        $request->session()->put('url.intended', $request->url());

        $remember = $request->has('remember');
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $request->merge([
                'email' => $request->email
            ]);
            $credentials = $request->only('email', 'password');
        } else {
            $request->merge([
                'username' => $request->email
            ]);
            $credentials = $request->only('username', 'password');
        }

        if (!Auth::attempt($credentials, $remember)) {

            return (object) [
                'status' => false,
                'message' => 'Identifiant ou mot de passe incorrect.'
            ];
        }

        if (auth()->user()->is_active == 0) {
            AuthenticationController::logout($request);
            return (object) [
                'status' => false,
                'message' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.'
            ];
        }

        if ($request->filled('url')) {
            return redirect($request->url);
        } elseif ($request->session()->has('url.intended.url')) {
            return redirect($request->session()->get('url.intended.url'));
        }

        $request->session()->regenerate();

        Log::channel('login')->info('Connexion de l\'utilisateur : (' . auth()->user()->id . ') ' .auth()->user()->username);

        return (object) [
            'status' => true,
            'message' => 'Connexion réussie.'
        ];
    }

    public static function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = AuthenticationController::loginService($request);

        if (!$login->status) {

            return back()->withErrors([
                'email' => $login->message,
            ]);
        }

        return redirect()->route('home');
    }

    public static function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('connexion');
    }
}
