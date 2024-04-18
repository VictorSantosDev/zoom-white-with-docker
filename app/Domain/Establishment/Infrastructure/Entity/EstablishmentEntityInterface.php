<?php

declare(strict_types=1);

namespace App\Domain\Establishment\Infrastructure\Entity;

use App\Domain\Establishment\Entity\Establishment;

interface EstablishmentEntityInterface
{
    public function create(Establishment $establishment): Establishment;
    public function update(Establishment $establishment): Establishment;
    public function delete(int $id): bool;
}
