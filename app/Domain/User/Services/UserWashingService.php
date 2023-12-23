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

    public function create(Washing $washing): Washing
    {
        $this->establishmentService->show($washing->getEstablishmentId()?->get());
        return $this->washingService->create($washing);
    }

    public function show(int $id)
    {
        return $this->washingService->show($id);
    }

    public function list(
        int $establishmentId,
        ?string $name,
        ?string $active
    ) {
        return $this->washingService->listWashing($establishmentId, $name, $active);
    }

    public function delete(int $id): bool
    {
        return $this->washingService->delete($id);
    }
}
