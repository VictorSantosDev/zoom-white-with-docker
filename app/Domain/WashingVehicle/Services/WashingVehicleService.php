<?php

namespace App\Domain\WashingVehicle\Services;

use App\Domain\Establishment\Services\EstablishmentService;
use App\Domain\Washing\Services\WashingService;
use App\Domain\WashingVehicle\Entity\WashingVehicle;
use App\Domain\WashingVehicle\Factory\WashingVehicleFactory;
use App\Domain\WashingVehicle\Infrastructure\Entity\WashingVehicleEntityInterface;
use App\Domain\WashingVehicle\Infrastructure\Repository\WashingVehicleRepositoryInterface;
use App\Domain\WashingVehicleHasWashing\Services\WashingVehicleHasWashingService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class WashingVehicleService
{
    public function __construct(
        private EstablishmentService $establishmentService,
        private WashingService $washingService,
        private WashingVehicleHasWashingService $washingVehicleHasWashingService,
        private WashingVehicleEntityInterface $washingVehicleEntity,
        private WashingVehicleRepositoryInterface $washingVehicleRepository
    ) {
    }

    public function create(
        int $estableshimentId,
        array $washingIds,
        string $plate,
        string $model,
        string $color
    ): WashingVehicle {
        $employee = auth('employee')->user();
        $estableshiment = $this->establishmentService->show($estableshimentId);
        $this->isYourEstableshiment($employee->establishment_id, $estableshiment['establishment']->getId()->get());
        $washingCollect = $this->washingService->findAllWashingIds($washingIds);
        $pricesByWashigs = $this->sumPriceWashing($washingCollect->toArray());

        $washingVehicle = WashingVehicleFactory::createWashingVehicle(
            establishmentId: $estableshiment['establishment']->getId()->get(),
            employeeId: $employee->id,
            plate: $plate,
            model: $model,
            color: $color,
            price: $pricesByWashigs
        );

        $washingVehicle = $this->washingVehicleEntity->create($washingVehicle);

        $this->saveWashingVehicleHasWashing(
            $washingVehicle->getId()->get(),
            $washingCollect->toArray()
        );

        return $washingVehicle;
    }

    public function update(
        int $washingVehicleId,
        array $washingIds,
        string $plate,
        string $model,
        string $color
    ): WashingVehicle {
        $employee = auth('employee')->user();
        $washingVehicle = $this->washingVehicleRepository->getByIdTryFrom($washingVehicleId);
        $this->isYourEstableshiment($employee->establishment_id, $washingVehicle->getEstablishmentId()->get());
        $washingCollect = $this->washingService->findAllWashingIds($washingIds);
        $pricesByWashigs = $this->sumPriceWashing($washingCollect->toArray());

        $washingVehicleUpdate = WashingVehicleFactory::createWashingVehicle(
            establishmentId: $washingVehicle->getEstablishmentId()->get(),
            employeeId: $washingVehicle->getEmployeeId()->get(),
            plate: $plate,
            model: $model,
            color: $color,
            price: $pricesByWashigs
        );

        $washingVehicleUpdated = $this->washingVehicleEntity->update(
            $washingVehicle->getId()->get(),
            $washingVehicleUpdate
        );

        $this->updateWashingVehicleHasWashing($washingVehicleId, $washingCollect->toArray());

        return $washingVehicleUpdated;
    }

    public function show(int $washingVehicleId): WashingVehicle
    {
        $employee = auth('employee')->user();
        $washingVehicle = $this->washingVehicleRepository->getByIdTryFrom($washingVehicleId);
        $this->isYourEstableshiment($employee->establishment_id, $washingVehicle->getEstablishmentId()->get());

        return $washingVehicle;
    }

    public function listAction(
        int $establishmentId,
        ?int $employeeId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ): array {
        $employee = auth('employee')->user();
        $this->isYourEstableshiment($employee->establishment_id, $establishmentId);

        return $this->washingVehicleRepository->listWashingVehicleByEstablishmentId(
            $establishmentId,
            $employeeId,
            $plate,
            $model,
            $color,
            $price,
            $limitPerPage
        );
    }

    public function delete(int $washingVehicleId): bool
    {
        $employee = auth('employee')->user();
        $washingVehicle = $this->washingVehicleRepository->getByIdTryFrom($washingVehicleId);
        $this->isYourEstableshiment($employee->establishment_id, $washingVehicle->getEstablishmentId()->get());
        return $this->washingVehicleEntity->delete($washingVehicleId);
    }

    private function saveWashingVehicleHasWashing(
        int $washingVehicleId,
        array $washingCollect
    ): void {
        foreach ($washingCollect as $washing) {
            $this->washingVehicleHasWashingService->create(
                washingVehicleId: $washingVehicleId,
                washingId: $washing['id']
            );
        }
    }

    private function updateWashingVehicleHasWashing(
        int $washingVehicleId,
        array $washingCollect
    ): void {
        $this->washingVehicleHasWashingService->updateByWashingVehicle(
            $washingVehicleId,
            $washingCollect
        );
    }

    private function sumPriceWashing(array $washings): int
    {
        /** @ not used validation down */
        // if (empty($washings)) {
        //     throw new Exception('Não foi possível encontrar as lavagens');
        // }

        $price = 0;

        foreach ($washings as $washing) {
            $price += $washing['price'];
        }

        return $price;
    }

    private function isYourEstableshiment(
        int $employeeEstableshimentId,
        int $estableshimentId
    ): void {
        if ($employeeEstableshimentId !== $estableshimentId) {
            throw new Exception('O usuário não pertence a esse estabelecimento.');
        }
    }
}
