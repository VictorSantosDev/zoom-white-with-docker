<?php

namespace App\Domain\Coupons\Infrastructure\Repository;

use App\Domain\Coupons\Entity\Coupons;

interface CouponsRepositoryInterface
{
    public function getByIdTryFrom(int $id): Coupons;
    public function getByEstablishmentId(int $establishmentId): ?Coupons;
}
