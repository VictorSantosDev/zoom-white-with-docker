<?php

namespace App\Domain\Service\Services;

use App\Domain\Service\Entity\ServiceEntity;
use App\Domain\Service\Infrastructure\Entity\ServiceEntityInterface;
use App\Domain\Service\Infrastructure\Repository\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceMain
{
    public function __construct(
        private ServiceEntityInterface $serviceEntityInterface,
        private ServiceRepositoryInterface $serviceRepositoryInterface
    ) {
    }

    public function create(ServiceEntity $serviceEntity): ServiceEntity
    {
        return $this->serviceEntityInterface->create($serviceEntity);
    }

    public function show(int $id): ServiceEntity
    {
        return $this->serviceRepositoryInterface->getByIdTryFrom($id);
    }

    public function list(
        int $establishmentId,
        ?int $categoryId,
        ?string $name,
        ?int $price,
        ?int $limitPerPage
    ): array {
        return $this->serviceRepositoryInterface->listServiceByEstablishmentId(
            $establishmentId,
            $categoryId,
            $name,
            $price,
            $limitPerPage
        );
    }

    public function delete(int $id): bool
    {
        return $this->serviceEntityInterface->delete($id);
    }

    public function findServiceIds(array $serviceIds): Collection
    {
        return $this->serviceRepositoryInterface->getByServiceIds($serviceIds);
    }
}
