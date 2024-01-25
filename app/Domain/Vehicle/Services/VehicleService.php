<?php

namespace App\Domain\Vehicle\Services;

use App\Domain\Establishment\Services\EstablishmentService;
use App\Domain\Service\Services\ServiceMain;
use App\Domain\ServiceHasVehicle\Services\ServiceHasVehicleService;
use App\Domain\Vehicle\Entity\Vehicle;
use App\Domain\Vehicle\Factory\VehicleFactory;
use App\Domain\Vehicle\Infrastructure\Entity\VehicleEntityInterface;
use App\Domain\Vehicle\Infrastructure\Repository\VehicleRepositoryInterface;

class VehicleService
{
    public function __construct(
        private VehicleEntityInterface $vehicleEntityInterface,
        private VehicleRepositoryInterface $vehicleRepositoryInterface,
        private ServiceHasVehicleService $serviceHasVehicleService,
        private ServiceMain $serviceMain,
        private EstablishmentService $establishmentService
    ) {
    }

    public function create(Vehicle $vehicle, array $serviceIds): Vehicle
    {
        $employee = auth('employee')->user();
        $this->establishmentService->show();
        $serviceCollect = $this->serviceMain->findServiceIds($serviceIds);
        $price = $this->sumServices($serviceCollect->toArray());
        $vehicle = $this->vehicleEntityInterface->create(
            VehicleFactory::create(
                vehicle: $vehicle,
                price: $price,
                employeeId: $employee->id
            )
        );
        $this->saveServiceHasVehicle($serviceCollect->toArray(), $vehicle);
        return $vehicle;
    }

    public function update(Vehicle $vehicle, array $serviceIds): Vehicle
    {
    }

    private function saveServiceHasVehicle(array $serviceCollect, Vehicle $vehicle): void
    {
        foreach ($serviceCollect as $service) {
            $this->serviceHasVehicleService->create(
                $service['id'],
                $vehicle->getId()->get()
            );
        }
    }

    private function sumServices(array $services): int
    {
        return array_reduce($services, function ($price, $services) {
            return $price += $services['price'] ?? 0;
        }, 0);
    }
}
