<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeEstablishment;
use App\Domain\Establishment\Entity\Establishment;
use App\Domain\Establishment\Infrastructure\Repository\EstablishmentRepositoryInterface;
use App\Models\Establishment as ModelEstablishment;
use Exception;

class EstablishmentRepository implements EstablishmentRepositoryInterface
{
    public function __construct(
        private ModelEstablishment $db
    ) {
    }

    public function findEstablishmentByDocument(int $userId, string $document): ?Establishment
    {
        $row = $this->db::where('user_id', $userId)
            ->where('document', $document)
            ->first();

        if (!$row) {
            return null;
        }

        return new Establishment(
            id: new Id($row->id),
            userId: new Id($row->id),
            nameByCompany: $row->name_by_company,
            document: $row->document,
            type: TypeEstablishment::tryFrom($row->type),
            corSystem: $row->cor_system,
            active: Active::tryFrom($row->active),
            pathLogo: $row->path_logo,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function listEstablishmentByUserId(
        int $userId,
        ?string $nameByCompany,
        ?string $document,
        ?string $type
    ): array {
        $row = $this->db::where('user_id', $userId);

        if ($nameByCompany) {
            $row = $this->db->where('name_by_company', 'LIKE', "%$nameByCompany");
        }

        if ($document) {
            $row = $this->db->where('document', 'LIKE', "%$document");
        }

        if ($type) {
            $row = $this->db->where('type', $type);
        }

        $row = $row->paginate(10);

        return $row->toArray();
    }

    public function getByIdTryFrom(int $id): Establishment
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Empresa não encontrado');
        }

        return new Establishment(
            id: new Id($row->id),
            userId: new Id($row->id),
            nameByCompany: $row->name_by_company,
            document: $row->document,
            type: TypeEstablishment::tryFrom($row->type),
            corSystem: $row->cor_system,
            active: Active::tryFrom($row->active),
            pathLogo: $row->path_logo,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
