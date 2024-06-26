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
        $user = auth('users')->user();
        $this->establishmentService->findEstablishmentByUserId($user->id);
        $serviceCollect = $this->serviceMain->findServiceIds($serviceIds);
        $price = $this->sumServices($serviceCollect->toArray());
        $vehicle = $this->vehicleEntityInterface->create(
            VehicleFactory::create(
                vehicle: $vehicle,
                price: $price,
                userId: $user->id
            )
        );
        $this->saveServiceHasVehicle($serviceCollect->toArray(), $vehicle);
        return $vehicle;
    }

    public function update(Vehicle $vehicle, array $serviceIds): Vehicle
    {
        $user = auth('users')->user();
        $this->establishmentService->findEstablishmentByUserId($user->id);
        $this->vehicleRepositoryInterface->getByIdTryFrom(
            $vehicle->getId()->get()
        );
        $serviceCollect = $this->serviceMain->findServiceIds($serviceIds);
        $price = $this->sumServices($serviceCollect->toArray());
        $vehicleUpdated = $this->vehicleEntityInterface->update(
            VehicleFactory::create(
                vehicle: $vehicle,
                price: $price,
                userId: $user->id
            )
        );

        $this->updateServiceHasVehicle(
            $vehicleUpdated->getId()->get(),
            $serviceCollect->toArray()
        );

        return $vehicleUpdated;
    }

    public function show(int $id): Vehicle
    {
        return $this->vehicleRepositoryInterface->getByIdTryFrom($id);
    }

    public function showFull(int $id): array
    {
        $vehicle = $this->vehicleRepositoryInterface->getByIdTryFrom($id);

        $vehicleJoinServices = $this->vehicleRepositoryInterface->getVehicleJoinServices(
            $vehicle->getId()->get()
        );

        return [
            'vehicle' => $vehicle,
            'services' => $vehicleJoinServices,
        ];
    }

    public function list(
        int $establishmentId,
        ?int $companyId,
        ?int $userId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ): array {
        return $this->vehicleRepositoryInterface->list(
            $establishmentId,
            $companyId,
            $userId,
            $plate,
            $model,
            $color,
            $price,
            $limitPerPage
        );
    }

    public function delete(int $id): bool
    {
        return $this->vehicleEntityInterface->delete($id);
    }

    private function updateServiceHasVehicle(int $vehicleId, array $serviceCollect): void
    {
        $this->serviceHasVehicleService->update($vehicleId, $serviceCollect);
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
