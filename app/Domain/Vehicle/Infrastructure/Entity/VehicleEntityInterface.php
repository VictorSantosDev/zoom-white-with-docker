<?php

namespace App\Domain\Vehicle\Infrastructure\Entity;

use App\Domain\Vehicle\Entity\Vehicle;

interface VehicleEntityInterface
{
    public function create(Vehicle $vehicle): Vehicle;
    public function update(Vehicle $vehicle): Vehicle;
    public function delete(int $id): bool;
}
