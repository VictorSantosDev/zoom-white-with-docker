<?php

namespace App\Domain\Washing\Services;

use App\Domain\Washing\Entity\Washing;
use App\Domain\Washing\Infrastructure\Entity\WashingEntityInterface;
use App\Domain\Washing\Infrastructure\Repository\WashingRepositoryInterface;

class WashingService
{
    public function __construct(
        private WashingEntityInterface $washingEntityInterface,
        private WashingRepositoryInterface $washingRepositoryInterface
    ) {
    }

    public function create(Washing $washing): Washing
    {
        return $this->washingEntityInterface->create($washing);
    }
}
