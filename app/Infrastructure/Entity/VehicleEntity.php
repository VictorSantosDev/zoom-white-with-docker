<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;
use App\Domain\Vehicle\Infrastructure\Entity\VehicleEntityInterface;
use App\Models\Vehicle as ModelVehicle;
use Exception;

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
            'user_id' => $vehicle->getUserId()->get(),
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
            userId: $vehicle->getUserId(),
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

    public function update(Vehicle $vehicle): Vehicle
    {
        $row = $this->db::where('id', $vehicle->getId()->get())->first();

        $row->plate = $vehicle->getPlate();
        $row->model = $vehicle->getModel();
        $row->color = $vehicle->getColor();
        $row->price = $vehicle->getPrice();
        $row->save();

        return new Vehicle(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            userId: new Id($row->user_id),
            companyId: new Id($row->company_id),
            plate: $vehicle->getPlate(),
            model: $vehicle->getModel(),
            color: $vehicle->getColor(),
            price: $vehicle->getPrice(),
            createdAt: $vehicle->getCreatedAt(),
            updatedAt: $vehicle->getUpdatedAt(),
            deletedAt: $vehicle->getDeletedAt()
        );
    }

    public function delete(int $id): bool
    {
        $delete = $this->db::where('id', $id)->delete();

        if ($delete === 0) {
            throw new Exception('Não foi possível excluir esse veículo');
        }

        return true;
    }
}
