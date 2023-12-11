<?php

namespace App\Domain\Admin\Services;

use App\Domain\Admin\Entity\User;
use App\Mail\SendEmailUserCreated;
use Illuminate\Support\Facades\Mail;

class AdminSendingEmail
{
    public function sendEmailUserCreated(User $user)
    {
        Mail::to('victor_santos1162@hotmail.com', 'Victor teste 1')->send(
            new SendEmailUserCreated()
        );

        dd($user);
    }
}
