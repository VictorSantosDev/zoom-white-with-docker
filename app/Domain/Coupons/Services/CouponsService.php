<?php

namespace App\Domain\Coupons\Services;

use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Infrastructure\Entity\CouponsEntityInterface;
use App\Domain\Coupons\Infrastructure\Repository\CouponsRepositoryInterface;
use App\Domain\Enum\Active;
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

    public function update(Coupons $coupons): Coupons
    {
        $this->couponsRepositoryInterface->getByIdTryFrom($coupons->getId()->get());
        return $this->couponsEntityInterface->update($coupons);
    }

    public function show(int $id): Coupons
    {
        return $this->couponsRepositoryInterface->getByIdTryFrom($id);
    }

    public function enableOrDisable(int $id, int $active): bool
    {
        $coupons = $this->couponsRepositoryInterface->getByIdTryFrom($id);
        $this->checkIfEnabledOrDisabled($coupons, $active);
        return $this->couponsEntityInterface->enableOrDisable($coupons->getId()->get(), $active);
    }

    private function checkIfEnabledOrDisabled(Coupons $coupons, int $active): void
    {
        if ($coupons->getActive()->value === $active && Active::ACTIVE->value === $active) {
            throw new Exception('Não é possível habilitar um cupom já habilitado');
        }

        if ($coupons->getActive()->value === $active && Active::INACTIVE->value === $active) {
            throw new Exception('Não é possível desabilitar um cupom já desabilitado');
        }
    }

    private function existCoupon(int $establishmentId): void
    {
        $coupons = $this->couponsRepositoryInterface->getByEstablishmentId($establishmentId);

        if ($coupons) {
            throw new Exception('Já existe um cupom para esse estabelecimento');
        }
    }
}
