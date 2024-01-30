<?php

namespace App\Http\Controllers;

use App\Utils\CustomSession;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        return view('public.account');
    }

    public function indexFavoris()
    {
        if (!request()->input('page'))
        {
            $sess = new CustomSession();
            $sess->favorite_search = '';
            $sess->save();
        }

        return view('public.favoris');
    }

    public function indexComment()
    {
        if (!request()->input('page'))
        {
            $sess = new CustomSession();
            $sess->comment_search = '';
            $sess->save();
        }

        return view('public.comment');
    }

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
