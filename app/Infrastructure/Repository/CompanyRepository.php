<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Infrastructure\Repository\CompanyRepositoryInterface;
use App\Models\Company as ModelsCompany;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(
        private ModelsCompany $db
    ) {
    }

    public function getByIdTryFrom(?int $id): Company
    {
        dd('get');
    }

    public function existCompany(Company $company): ?Company
    {
        $row = $this->db::where('document', $company->getDocument())
            ->where('establishment_id', $company->getEstablishmentId()?->get())
            ->first();

        if (!$row) {
            return null;
        }

        return new Company(
            id: new Id($row->id),
            establishmentId: $company->getEstablishmentId(),
            companyName: $company->getCompanyName(),
            fantasyName: $company->getFantasyName(),
            document: $company->getDocument(),
            phone: $company->getPhone(),
            email: $company->getEmail(),
            closingDate: $company->getClosingDate(),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
