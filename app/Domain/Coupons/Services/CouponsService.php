<?php

namespace App\Domain\Coupons\Services;

use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Infrastructure\Entity\CouponsEntityInterface;
use App\Domain\Coupons\Infrastructure\Repository\CouponsRepositoryInterface;
use Exception;

class CouponsService
{
    public function __construct(
        private CouponsEntityInterface $couponsEntityInterface,
        private CouponsRepositoryInterface $couponsRepositoryInterface
    ) {
    }

    public function create(Coupons $coupons): Coupons
    {
        $this->existCoupon($coupons->getEstablishmentId()->get());
        return $this->couponsEntityInterface->create($coupons);
    }

    private function existCoupon(int $establishmentId): void
    {
        $coupons = $this->couponsRepositoryInterface->getByEstablishmentId($establishmentId);

        if ($coupons) {
            throw new Exception('Já existe um cupom para esse estabelecimento');
        }
    }
}
