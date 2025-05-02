<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        if (!$user) {
            // Create a new user if not exists
            $user = User::create([
                'username' => $fullName . Str::uuid()->toString(),
                'prenom' => $parts[0],
                'nom' => $parts[1] ?? '',

                'telephone' => null,
                'email' => $googleUser->getEmail(),       // ajoute l'email ici           // à définir ou laisser vide

                'password' => "vamiyi", // You can generate a random password
            ]);
            $user->assignRole($this->type);
            DB::commit();
        }

        Auth::login($user);

        return redirect()->intended('/');
    }
}
