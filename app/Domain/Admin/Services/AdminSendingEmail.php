<?php

namespace App\Domain\Admin\Services;

use App\Domain\Admin\Entity\User;

class AdminSendingEmail
{
    public function sendEmailUserCreated(User $user)
    {
        dd($user);
    }
}
