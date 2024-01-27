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

    public function update(int $vehicleId, array $serviceCollect): bool
    {
        $allServicesHasVehicle = $this->serviceHasVehicleRepositoryInterface->getAllByVehicleId($vehicleId);
        $diff = $this->getDiff($allServicesHasVehicle, $serviceCollect);
        $this->serviceHasVehicleEntityInterface->deleteByServiceIds($diff['remove']);
        $this->saveCollect($vehicleId, $diff['add']);
        return true;
    }

    private function saveCollect(int $vehicleId, array $addServiceIds): void
    {
        foreach ($addServiceIds as $serviceId) {
            $this->create($serviceId, $vehicleId);
        }
    }

    private function getDiff(array $allServicesHasVehicle, array $serviceCollect): array
    {
        $serviceIdsCurrent = [];
        $serviceIdsNew = [];

        foreach ($allServicesHasVehicle as $servicesHasVehicle) {
            $serviceIdsCurrent[] = $servicesHasVehicle['service_id'];
        }

        foreach ($serviceCollect as $service) {
            $serviceIdsNew[] = $service['id'];
        }

        return [
            'add' => array_diff($serviceIdsNew, $serviceIdsCurrent),
            'remove' => array_diff($serviceIdsCurrent, $serviceIdsNew)
        ];
    }
}
