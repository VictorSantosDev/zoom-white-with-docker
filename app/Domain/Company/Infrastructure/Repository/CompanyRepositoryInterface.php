<?php

namespace App\Domain\Company\Infrastructure\Repository;

use App\Domain\Company\Entity\Company;

interface CompanyRepositoryInterface
{
    public function getByIdTryFrom(?int $id): Company;
    public function existCompany(Company $company): ?Company;
    public function existDocumentCompany(Company $company, int $establishmentId): ?Company;
    public function list(
        int $establishmentId,
        ?string $companyName,
        ?string $fantasyName,
        ?string $document,
        ?string $phone,
        ?string $email,
        int $limitPerPage
    ): array;
}
