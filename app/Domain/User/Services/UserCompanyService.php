<?php

namespace App\Domain\User\Services;

use App\Domain\Address\Entity\Address;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Services\CompanyService;

class UserCompanyService
{
    public function __construct(
        private CompanyService $companyService
    ) {
    }

    public function create(
        Company $company,
        Address $address
    ): Company {
        return $this->companyService->create($company, $address);
    }

    public function update(
        Company $company,
        Address $address
    ): Company {
        return $this->companyService->update($company, $address);
    }

    public function show(int $id): Company
    {
        return $this->companyService->show($id);
    }

    public function list(
        int $establishmentId,
        ?string $companyName,
        ?string $fantasyName,
        ?string $document,
        ?string $phone,
        ?string $email,
        int $limitPerPage
    ): array {
        return $this->companyService->list(
            $establishmentId,
            $companyName,
            $fantasyName,
            $document,
            $phone,
            $email,
            $limitPerPage
        );
    }

    public function delete(int $id): bool
    {
        return $this->companyService->delete($id);
    }
}
