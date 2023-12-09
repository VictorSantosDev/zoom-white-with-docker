<?php

namespace App\Domain\Admin\Services;

use App\Domain\Admin\Entity\User;

class AdminUserService
{
    public function create(User $user)
    {
        dd($user);
    }
}
