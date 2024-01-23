<?php

namespace App\Domain\Service\Infrastructure\Entity;

use App\Domain\Service\Entity\ServiceEntity;

interface ServiceEntityInterface
{
    public function create(ServiceEntity $serviceEntity): ServiceEntity;
    public function delete(int $id): bool;
}
