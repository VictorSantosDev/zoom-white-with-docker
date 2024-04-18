<?php

namespace App\Domain\User\Services;

use App\Domain\Establishment\Services\EstablishmentService;

class UserEstablishmentService
{
    public function __construct(
        private EstablishmentService $establishmentService
    ) {
    }

    public function listEstablishmentByUser(): array
    {
        $user = auth('users')->user();
        return $this->establishmentService->listEstablishmentByUser($user->id);
    }
}
