<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        return view('public.account');
    }

    public function indexFavoris()
    {
        return view('public.favoris');
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
        ], [
            'email.exists' => 'Cette adresse email n\'existe pas.'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $status === Password::RESET_LINK_SENT;

        if (!$status) {
            return back()->withErrors(['email' => __($status)]);
        }

        return redirect()->route('notification.rest-password.success');
    }

    public function notificationSuccess()
    {
        return view('public.notifications.reset-email-success');
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
        ], [
            'token.exists' => 'Le token est invalide.',
            'email.exists' => 'Cette adresse email n\'existe pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            AuthenticationController::login($request);
            return redirect('/');
        } else {
            return back()->withErrors(['email' => 'Le lien de réinitialisation a expiré.']);
        }
    }

    public function editPassword()
    {
        return view('new-password');
    }
}
