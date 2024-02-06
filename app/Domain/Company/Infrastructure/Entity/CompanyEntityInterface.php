<?php

namespace App\Domain\Company\Infrastructure\Entity;

use App\Domain\Company\Entity\Company;

interface CompanyEntityInterface
{
    public function create(Company $company): Company;
    public function update(Company $company): Company;
    public function delete(int $id): bool;
}
