<?php

namespace App\Domain\Company\Services;

use App\Domain\Address\Entity\Address;
use App\Domain\Address\Services\AddressService;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Infrastructure\Entity\CompanyEntityInterface;
use App\Domain\Company\Infrastructure\Repository\CompanyRepositoryInterface;
use Exception;

class CompanyService
{
    public function __construct(
        private CompanyEntityInterface $companyEntity,
        private CompanyRepositoryInterface $companyRepositoryInterface,
        private AddressService $addressService
    ) {
    }

    public function create(
        Company $company,
        Address $address
    ) {
        /** @todo validar se a company já é cadastrada com esse documento. */
        $company = $this->companyEntity->create($company);
        $address = $this->addressService->createAddressCompany($address, $company->getId()->get());

        return $company;
    }

    private function validateCompany(Company $company)
    {
        if ($this->companyRepositoryInterface->findByDocument($company->getDocument())) {
            throw new Exception('Já existe uma empresa com esse documento');
        }
    }
}
