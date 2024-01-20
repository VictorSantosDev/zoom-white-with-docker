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

    public function update()
    {
    }

    public function show()
    {
    }

    public function list()
    {
    }

    public function delete()
    {
    }
}
