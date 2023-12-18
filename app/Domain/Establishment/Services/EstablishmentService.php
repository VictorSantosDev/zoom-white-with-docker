<?php

declare(strict_types=1);

namespace App\Domain\Establishment\Services;

use App\Domain\Establishment\Entity\Establishment;
use App\Domain\Establishment\Infrastructure\Entity\EstablishmentEntityInterface;
use App\Domain\Establishment\Infrastructure\Repository\EstablishmentRepositoryInterface;
use Exception;

class EstablishmentService
{
    public function __construct(
        private EstablishmentEntityInterface $establishmentEntityInterface,
        private EstablishmentRepositoryInterface $establishmentRepositoryInterface
    ) {
    }

    public function create(Establishment $establishment): Establishment
    {
        $this->existByUserWithDocument($establishment->getUserId()->get(), $establishment->getDocument());
        return $this->establishmentEntityInterface->create($establishment);
    }

    public function update(Establishment $establishment): Establishment
    {
        $this->existByUserWithOtherDocument($establishment->getId()->get(), $establishment->getDocument());
        return $this->establishmentEntityInterface->update($establishment);
    }

    public function listEstablishmentByUserId(
        int $userId,
        ?string $nameByCompany,
        ?string $document,
        ?string $type
    ): array {
        return $this->establishmentRepositoryInterface->listEstablishmentByUserId(
            $userId,
            $nameByCompany,
            $document,
            $type
        );
    }

    public function show(int $id): array
    {
        return $this->establishmentRepositoryInterface->getByIdTryFrom($id);
    }

    public function delete(int $id)
    {
        return $this->establishmentEntityInterface->delete($id);
    }

    private function existByUserWithDocument(int $userId, string $document): void
    {
        $establishment = $this->establishmentRepositoryInterface->findEstablishmentByDocument(
            $userId,
            $document
        );

        if ($establishment) {
            throw new Exception('Já existe uma empresa com esse documento cadastrado para esse usuário');
        }
    }

    private function existByUserWithOtherDocument(int $establishmentId, string $document): void
    {
        $establishment = $this->establishmentRepositoryInterface->findEstablishmentByOtherDocument(
            $establishmentId,
            $document
        );

        if ($establishment) {
            throw new Exception('Já existe uma empresa com esse documento cadastrado para esse usuário');
        }
    }
}
