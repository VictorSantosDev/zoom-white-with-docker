<?php

namespace App\Domain\User\Services;

use App\Domain\Establishment\Services\EstablishmentService;
use App\Domain\Washing\Entity\Washing;
use App\Domain\Washing\Services\WashingService;

class UserWashingService
{
    public function __construct(
        private WashingService $washingService,
        private EstablishmentService $establishmentService
    ) {
    }

    public function create(Washing $washing)
    {
        $this->establishmentService->show($washing->getEstablishmentId()?->get());
        $this->washingService->create($washing);
    }
}
