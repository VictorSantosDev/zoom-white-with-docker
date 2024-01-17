<?php

namespace App\Domain\Company\Infrastructure\Entity;

use App\Domain\Company\Entity\Company;

interface CompanyEntityInterface
{
    public function create(Company $company): Company;
}
