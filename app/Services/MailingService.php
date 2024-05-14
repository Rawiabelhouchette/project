<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailingService
{
    public static function sendSuccessSubscriptionMail($user, $subscription)
    {
        $message = '';
        // Code to send email to billson@gmail.com
        Mail::send('email.success-subscription', [
            'user' => $user,
            'subscription' => $subscription,
        ], function ($message) {
            $message->to('billalisonhouin@gmail.com')
                ->subject('Bienvenue sur la plateforme de publication des annonces');
        });
    }
}
