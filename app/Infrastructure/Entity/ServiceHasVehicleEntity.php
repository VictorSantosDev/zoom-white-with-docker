<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\ServiceHasVehicle\Entity\ServiceHasVehicle;
use App\Domain\ServiceHasVehicle\Infrastructure\Entity\ServiceHasVehicleEntityInterface;
use App\Models\ServiceHasVehicle as ModelServiceHasVehicle;

class ServiceHasVehicleEntity implements ServiceHasVehicleEntityInterface
{
    public function __construct(
        private ModelServiceHasVehicle $db
    ) {
    }

    public function create(ServiceHasVehicle $serviceHasVehicle): ServiceHasVehicle
    {
        $row = $this->db::create([
            'service_id' => $serviceHasVehicle->getServiceId()?->get(),
            'vehicle_id' => $serviceHasVehicle->getVehicleId()?->get(),
            'created_at' => $serviceHasVehicle->getCreatedAt(),
            'updated_at' => $serviceHasVehicle->getUpdatedAt(),
            'deleted_at' => $serviceHasVehicle->getDeletedAt(),
        ]);

        return new ServiceHasVehicle(
            id: new Id($row->id),
            serviceId: $serviceHasVehicle->getServiceId(),
            vehicleId: $serviceHasVehicle->getVehicleId(),
            createdAt: $serviceHasVehicle->getCreatedAt(),
            updatedAt: $serviceHasVehicle->getUpdatedAt(),
            deletedAt: $serviceHasVehicle->getDeletedAt()
        );
    }

    public function deleteByServiceIds(array $servicesIds): bool
    {
        $rows = $this->db::whereIn('service_id', $servicesIds)->get();
        $rows->each->delete();

        return true;
    }
}
