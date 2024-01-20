<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Infrastructure\Entity\CompanyEntityInterface;
use App\Models\Company as ModelsCompany;

class CompanyEntity implements CompanyEntityInterface
{
    public function __construct(
        private ModelsCompany $db
    ) {
    }

    public function create(Company $company): Company
    {;
        $row = $this->db::create([
            'establishment_id' => $company->getEstablishmentId()->get(),
            'company_name' => $company->getCompanyName(),
            'fantasy_name' => $company->getFantasyName(),
            'document' => $company->getDocument(),
            'phone' => $company->getPhone(),
            'email' => $company->getEmail(),
            'closing_date' => $company->getClosingDate(),
            'created_at' => $company->getCreatedAt(),
            'updated_at' => $company->getUpdatedAt(),
            'deleted_at' => $company->getDeletedAt(),
        ]);

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
