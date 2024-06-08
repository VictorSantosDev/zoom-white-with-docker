<?php

namespace App\Domain\User\Services;

use App\Domain\Admin\Entity\User;
use App\Mail\SendEmailResetPassword;
use Illuminate\Support\Facades\Mail;

class UserSendingEmailService
{
    public function sendPasswordReset(User $user, string $hash)
    {
        Mail::send(
            new SendEmailResetPassword(
                $user->getEmail(),
                $user->getName(),
                $hash
            )
        );
    }
}
