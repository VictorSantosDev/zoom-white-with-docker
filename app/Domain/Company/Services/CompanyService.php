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
    ): Company {
        // $user = auth('users')->user();
        // $this->isYourEstableshiment($employee->establishment_id, $company->getEstablishmentId()->get());
        $this->validateCompany($company);
        $company = $this->companyEntity->create($company);
        $address = $this->addressService->createAddressCompany($address, $company->getId()->get());
        return $company;
    }

    private function validateCompany(Company $company): void
    {
        if ($this->companyRepositoryInterface->existCompany($company)) {
            throw new Exception('Já existe uma empresa com esse documento');
        }
    }

    // private function isYourEstableshiment(
    //     int $employeeEstableshimentId,
    //     int $estableshimentId
    // ): void {
    //     if ($employeeEstableshimentId !== $estableshimentId) {
    //         throw new Exception('O usuário não pertence a esse estabelecimento.');
    //     }
    // }
}
