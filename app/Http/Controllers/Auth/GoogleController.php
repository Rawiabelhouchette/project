<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public $type = 'Usager';

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        $fullName = $googleUser->getName();
        $parts = explode(' ', $fullName, 2);

        DB::beginTransaction();
        if (! $user) {
            // Create a new user if not exists
            $user = User::create([
                'username' => $fullName.Str::uuid()->toString(),
                'prenom' => $parts[0],
                'nom' => $parts[1] ?? $parts[0],

                'telephone' => null,
                'email' => $googleUser->getEmail(),       // ajoute l'email ici           // à définir ou laisser vide

                'password' => 'vamiyi', // You can generate a random password
            ]);
            $user->assignRole($this->type);
            DB::commit();
        }

        Auth::login($user);

        return redirect()->intended('/');
    }
}
