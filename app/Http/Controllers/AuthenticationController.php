<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public static function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Enregistrer l'url courant dans la session
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

        if (Auth::attempt($credentials, $remember)) {
            if (auth()->user()->is_active == 0) {
                AuthenticationController::logout($request);
                return back()->withErrors([
                    'email' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.',
                ]);
            }

            if ($request->filled('url')) {
                return redirect($request->url);
            } elseif ($request->session()->has('url.intended.url')) {
                return redirect($request->session()->get('url.intended.url'));
            }

            $request->session()->regenerate();

            // return redirect()->intended('/');
            // return back();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Identifiant ou mot de passe incorrect.',
        ]);
    }

    public static function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('connexion');
    }
}
