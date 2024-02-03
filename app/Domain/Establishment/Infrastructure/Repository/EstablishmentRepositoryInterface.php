<?php

declare(strict_types=1);

namespace App\Domain\Establishment\Infrastructure\Repository;

use App\Domain\Establishment\Entity\Establishment;

interface EstablishmentRepositoryInterface
{
    public function findEstablishmentByDocument(int $userId, string $document): ?Establishment;
    public function findEstablishmentByOtherDocument(int $establishmentId, string $document): ?Establishment;
    public function listEstablishmentByUserId(
        int $userId,
        ?string $nameByCompany,
        ?string $document,
        ?string $type
    ): array;
    public function getByIdTryFrom(int $id): array;
    public function getByUserIdTryFrom(?int $userId): array;
    public function getByUserIdAndEstablishmentIdTryFrom(?int $userId, ?int $establishmentId): ?array;
}
