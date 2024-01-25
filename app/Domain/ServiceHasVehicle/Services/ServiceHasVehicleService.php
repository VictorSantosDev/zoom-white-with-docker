<?php

namespace App\Domain\ServiceHasVehicle\Services;

use App\Domain\ServiceHasVehicle\Entity\ServiceHasVehicle;
use App\Domain\ServiceHasVehicle\Factory\ServiceHasVehicleFactory;
use App\Domain\ServiceHasVehicle\Infrastructure\Entity\ServiceHasVehicleEntityInterface;
use App\Domain\ServiceHasVehicle\Infrastructure\Repository\ServiceHasVehicleRepositoryInterface;

class ServiceHasVehicleService
{
    public function __construct(
        private ServiceHasVehicleEntityInterface $serviceHasVehicleEntityInterface,
        private ServiceHasVehicleRepositoryInterface $serviceHasVehicleRepositoryInterface
    ) {
    }

    public function create(int $serviceId, int $vehicleId): ServiceHasVehicle
    {
        return $this->serviceHasVehicleEntityInterface->create(
            ServiceHasVehicleFactory::create(
                serviceId: $serviceId,
                vehicleId: $vehicleId
            )
        );
    }
}
