<?php

namespace App\Domain\Washing\Services;

use App\Domain\Washing\Entity\Washing;
use App\Domain\Washing\Infrastructure\Entity\WashingEntityInterface;
use App\Domain\Washing\Infrastructure\Repository\WashingRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class WashingService
{
    private const TOTAL_WASHING = 20;

    public function __construct(
        private WashingEntityInterface $washingEntityInterface,
        private WashingRepositoryInterface $washingRepositoryInterface
    ) {
    }

    public function create(Washing $washing): Washing
    {
        $washingCollect = $this->washingRepositoryInterface->getAllWashing(
            $washing->getEstablishmentId()->get()
        );

        if (count($washingCollect) >= self::TOTAL_WASHING) {
            throw new Exception('O estabelecimento só pode ter no máximo ' . self::TOTAL_WASHING . ' lavagens cadatradas');
        }

        return $this->washingEntityInterface->create($washing);
    }

    public function show(int $id): Washing
    {
        return $this->washingRepositoryInterface->getByIdTryFrom($id);
    }

    public function listWashing(int $establishmentId, ?string $name, ?string $active): array
    {
        return $this->washingRepositoryInterface->listWashingByEstablishmentId(
            $establishmentId,
            $name,
            $active
        );
    }

    public function delete(int $id): bool
    {
        return $this->washingEntityInterface->delete($id);
    }

    public function findAllWashingIds(array $washingIds): Collection
    {
        return $this->washingRepositoryInterface->getAllWashingByIds($washingIds);
    }
}
