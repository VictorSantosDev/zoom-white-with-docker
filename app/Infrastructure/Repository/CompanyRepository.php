<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Infrastructure\Repository\CompanyRepositoryInterface;
use App\Models\Company as ModelsCompany;
use Exception;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(
        private ModelsCompany $db
    ) {
    }

    public function getByIdTryFrom(?int $id): Company
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Empresa não encontrada');
        }

        return new Company(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            companyName: $row->company_name,
            fantasyName: $row->fantasy_name,
            document: $row->document,
            phone: $row->phone,
            email: $row->email,
            closingDate: $row->closing_date,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
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

    public function existDocumentCompany(Company $company, int $establishmentId): ?Company
    {
        $row = $this->db::where('id', '<>', $company->getId()->get())
            ->where('document', $company->getDocument())
            ->where('establishment_id', $establishmentId)
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

    public function list(
        int $establishmentId,
        ?string $companyName,
        ?string $fantasyName,
        ?string $document,
        ?string $phone,
        ?string $email,
        int $limitPerPage
    ): array {
        $row = $this->db::where('establishment_id', $establishmentId);

        if ($companyName) {
            $row = $this->db::where('company_name', 'LIKE', "$companyName%");
        }

        if ($fantasyName) {
            $row = $this->db::where('fantasy_name', 'LIKE', "$fantasyName%");
        }

        if ($document) {
            $row = $this->db::where('document', 'LIKE', "$document%");
        }

        if ($phone) {
            $row = $this->db::where('phone', 'LIKE', "$phone%");
        }

        if ($email) {
            $row = $this->db::where('email', 'LIKE', "$email%");
        }

        return $row->paginate($limitPerPage)->toArray();
    }
}
