<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeEstablishment;
use App\Domain\Establishment\Entity\Establishment;
use App\Domain\Establishment\Infrastructure\Entity\EstablishmentEntityInterface;
use App\Models\Establishment as EntityEstablishment;
use Exception;

class EstablishmentEntity implements EstablishmentEntityInterface
{
    public function __construct(
        private EntityEstablishment $db
    ) {
    }

    public function create(Establishment $establishment): Establishment
    {
        $row = $this->db::create([
            'user_id' => $establishment->getUserId()->get(),
            'name_by_company' => $establishment->getNameByCompany(),
            'document' => $establishment->getDocument(),
            'type' => $establishment->getType()->value,
            'cor_system' => $establishment->getCorSystem(),
            'active' => $establishment->getActive()->value,
            'created_at' => $establishment->getCreatedAt(),
            'updated_at' => $establishment->getUpdatedAt(),
            'deleted_at' => $establishment->getDeletedAt(),
        ]);

        return new Establishment(
            id: new Id($row->id),
            userId: new Id($row->id),
            nameByCompany: $establishment->getNameByCompany(),
            document: $establishment->getDocument(),
            type: $establishment->getType(),
            corSystem: $establishment->getCorSystem(),
            active: $establishment->getActive(),
            pathLogo: $establishment->getPathLogo(),
            createdAt: $establishment->getCreatedAt(),
            updatedAt: $establishment->getUpdatedAt(),
            deletedAt: $establishment->getUpdatedAt(),
        );
    }

    public function update(Establishment $establishment): Establishment
    {
        $row = $this->db::where('id', $establishment->getId()->get())->first();

        if (!$row) {
            throw new Exception('Empresa não encontrada');
        }

        $row->name_by_company = $establishment->getNameByCompany();
        $row->document = $establishment->getDocument();
        $row->type = $establishment->getType()->value;
        $row->cor_system = $establishment->getCorSystem();
        $row->updated_at = $establishment->getUpdatedAt();
        $row->save();

        return new Establishment(
            id: new Id($row->id),
            userId: new Id($row->id),
            nameByCompany: $row->name_by_company,
            document: $row->document,
            type: TypeEstablishment::tryFrom($row->type),
            corSystem: $establishment->getCorSystem(),
            active: Active::tryFrom($row->active),
            pathLogo: $row->path_logo,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function delete(int $id): bool
    {
        $delete = $this->db::where('id', $id)->delete();

        if ($delete === 0) {
            throw new Exception('Não foi possível excluir esse estabelecimento');
        }

        return true;
    }
}
