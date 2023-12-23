<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Washing\Entity\Washing;
use App\Domain\Washing\Infrastructure\Entity\WashingEntityInterface;
use App\Models\Washing as ModelWashing;

class WashingEntity implements WashingEntityInterface
{
    public function __construct(
        private ModelWashing $db
    ) {
    }

    public function create(Washing $washing): Washing
    {
        $row = $this->db::create([
            'establishment_id' => $washing->getEstablishmentId()->get(),
            'name' => $washing->getName(),
            'price' => $washing->getPrice(),
            'active' => $washing->getActive()->value,
            'created_at' => $washing->getCreatedAt(),
            'updated_at' => $washing->getUpdatedAt(),
            'deleted_at' => $washing->getDeletedAt(),
        ]);

        return new Washing(
            id: new Id($row->id),
            establishmentId: $washing->getEstablishmentId(),
            name: $washing->getName(),
            price: $washing->getPrice(),
            active: $washing->getActive(),
            createdAt: $washing->getCreatedAt(),
            updatedAt: $washing->getUpdatedAt(),
            deletedAt: $washing->getDeletedAt(),
        );
    }
}
