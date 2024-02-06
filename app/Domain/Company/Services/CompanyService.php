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
        $establishment = $this->establishmentService->findEstablishmentByUserId($user->id);
        $this->validateDocumentCompanyExist($company, $establishment['establishment']->getId()->get());
        $currentCompany = $this->companyRepositoryInterface->getByIdTryFrom($company->getId()->get());
        $this->checkCompanyByEstablishment(
            $establishment['establishment']->getId()->get(),
            $currentCompany->getEstablishmentId()->get()
        );
        $company = $this->companyEntity->update($company);
        $address = $this->addressService->updateAddressCompany($address, $company->getId()->get());
        return $company;
    }

    public function show(int $id): Company
    {
        return $this->companyRepositoryInterface->getByIdTryFrom($id);
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
        return $this->companyRepositoryInterface->list(
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
        return $this->companyEntity->delete($id);
    }

    private function validateDocumentCompanyExist(Company $company, int $establishmentId): void
    {
        if ($this->companyRepositoryInterface->existDocumentCompany($company, $establishmentId)) {
            throw new Exception('Já existe uma empresa com esse documento');
        }
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

    private function checkCompanyByEstablishment(int $establishmentId, int $establishmentIdByCompany): void
    {
        if ($establishmentId !== $establishmentIdByCompany) {
            throw new Exception('O usuário não pertence a esse estabelecimento.');
        }
    }
}
