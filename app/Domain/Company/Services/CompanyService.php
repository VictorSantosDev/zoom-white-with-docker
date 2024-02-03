<?php

namespace App\Domain\Company\Services;

use App\Domain\Address\Entity\Address;
use App\Domain\Address\Services\AddressService;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Infrastructure\Entity\CompanyEntityInterface;
use App\Domain\Company\Infrastructure\Repository\CompanyRepositoryInterface;
use App\Domain\Establishment\Services\EstablishmentService;
use Exception;

class CompanyService
{
    public function __construct(
        private CompanyEntityInterface $companyEntity,
        private CompanyRepositoryInterface $companyRepositoryInterface,
        private AddressService $addressService,
        private EstablishmentService $establishmentService
    ) {
    }

    public function create(
        Company $company,
        Address $address
    ): Company {
        $user = auth('users')->user();
        $this->isYourEstableshiment($user->id, $company->getEstablishmentId()->get());
        $this->validateCompany($company);
        $company = $this->companyEntity->create($company);
        $address = $this->addressService->createAddressCompany($address, $company->getId()->get());
        return $company;
    }

    public function update(
        Company $company,
        Address $address
    ): Company {
        $user = auth('users')->user();
        $companyCurrent = $this->companyRepositoryInterface->getByIdTryFrom($company->getId()->get());
    }

    private function validateCompany(Company $company): void
    {
        if ($this->companyRepositoryInterface->existCompany($company)) {
            throw new Exception('Já existe uma empresa com esse documento');
        }
    }

    private function isYourEstableshiment(int $userId, int $establishmentId): void
    {
        $establishment = $this->establishmentService->findEstablishmentByUserIdAndEstablishmentId(
            $userId,
            $establishmentId
        );

        if (!$establishment) {
            throw new Exception('O usuário não pertence a esse estabelecimento.');
        }
    }
}
