<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Establishment\Entity\Establishment;
use App\Domain\Establishment\Infrastructure\Entity\EstablishmentEntityInterface;
use App\Models\Establishment as EntityEstablishment;

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
}
