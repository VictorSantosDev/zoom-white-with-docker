<?php

namespace App\Domain\Admin\Services;

use App\Domain\Admin\Entity\User;
use App\Mail\SendEmailUserCreated;
use Illuminate\Support\Facades\Mail;

class AdminSendingEmailService
{
    public function sendEmailUserCreated(User $user): void
    {
        Mail::send(
            new SendEmailUserCreated(
                email: $user->getEmail(),
                name: $user->getName(),
                password: $user->getPassword()
            )
        );
    }
}
