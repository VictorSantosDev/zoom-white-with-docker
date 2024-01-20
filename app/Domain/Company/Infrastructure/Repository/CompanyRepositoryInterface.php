<?php

namespace App\Domain\Company\Infrastructure\Repository;

use App\Domain\Company\Entity\Company;

interface CompanyRepositoryInterface
{
    public function getByIdTryFrom(?int $id): Company;
    public function existCompany(Company $company): ?Company;
}
