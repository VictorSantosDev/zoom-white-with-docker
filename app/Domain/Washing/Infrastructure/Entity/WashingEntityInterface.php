<?php

namespace App\Domain\Washing\Infrastructure\Entity;

use App\Domain\Washing\Entity\Washing;

interface WashingEntityInterface
{
    public function create(Washing $washing): Washing;
    public function delete(int $id): bool;
}
