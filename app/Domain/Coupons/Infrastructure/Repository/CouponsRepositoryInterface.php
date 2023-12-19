<?php

namespace App\Domain\Coupons\Infrastructure\Repository;

use App\Domain\Coupons\Entity\Coupons;

interface CouponsRepositoryInterface
{
    public function getByEstablishmentIdTryFrom(int $establishmentId);
    public function getByEstablishmentId(int $establishmentId): ?Coupons;
}
