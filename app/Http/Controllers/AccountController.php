<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AccountController extends Controller
{
    public function index()
    {
        return view('public.account');
    }

    public function indexFavoris()
    {
        $user = User::find(auth()->user()->id);
        $annonces = $user->favorisAnnonces()->paginate(2);
        return view('public.favoris', compact('annonces'));
    }

    // function to reset password using email
    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email'
    //     ]);

    //     $token = app('auth.password.broker')->createToken($request->email);

    //     return view('public.reset-password', ['token' => $token]);
    // }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
