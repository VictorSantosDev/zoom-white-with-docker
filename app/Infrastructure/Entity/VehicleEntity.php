<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;
use App\Domain\Vehicle\Infrastructure\Entity\VehicleEntityInterface;
use App\Models\Vehicle as ModelVehicle;

class VehicleEntity implements VehicleEntityInterface
{
    public function __construct(
        private ModelVehicle $db
    ) {
    }

    public function create(Vehicle $vehicle): Vehicle
    {
        $row = $this->db::create([
            'establishment_id' => $vehicle->getEstablishmentId()->get(),
            'employee_id' => $vehicle->getEmployeeId()->get(),
            'company_id' => $vehicle->getCompanyId()?->get(),
            'plate' => $vehicle->getPlate(),
            'model' => $vehicle->getModel(),
            'color' => $vehicle->getColor(),
            'price' => $vehicle->getPrice(),
            'created_at' => $vehicle->getCreatedAt(),
            'updated_at' => $vehicle->getUpdatedAt(),
            'deleted_at' => $vehicle->getDeletedAt(),
        ]);

        return new Vehicle(
            id: new Id($row->id),
            establishmentId: $vehicle->getEstablishmentId(),
            employeeId: $vehicle->getEmployeeId(),
            companyId: $vehicle->getCompanyId(),
            plate: $vehicle->getPlate(),
            model: $vehicle->getModel(),
            color: $vehicle->getColor(),
            price: $vehicle->getPrice(),
            createdAt: $vehicle->getCreatedAt(),
            updatedAt: $vehicle->getUpdatedAt(),
            deletedAt: $vehicle->getDeletedAt()
        );
    }
}
