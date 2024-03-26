<?php

namespace App\Domain\ServiceHasVehicle\Infrastructure\Entity;

use App\Domain\ServiceHasVehicle\Entity\ServiceHasVehicle;

interface ServiceHasVehicleEntityInterface
{
    public function create(ServiceHasVehicle $serviceHasVehicle): ServiceHasVehicle;
    public function deleteByServiceIds(array $servicesIds): bool;
}
