<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Service\Infrastructure\Entity\ServiceEntityInterface;
use App\Domain\Service\Entity\ServiceEntity;
use App\Models\Service as ModelService;
use Exception;

class ServiceEntityDB implements ServiceEntityInterface
{
    public function __construct(
        private ModelService $db
    ) {
    }

    public function create(ServiceEntity $serviceEntity): ServiceEntity
    {
        $row = $this->db::create([
            'establishment_id' => $serviceEntity->getEstablishmentId()->get(),
            'category_id' => $serviceEntity->getCategoryId()->get(),
            'name' => $serviceEntity->getName(),
            'price' => $serviceEntity->getPrice(),
            'active' => $serviceEntity->getActive(),
            'created_at' => $serviceEntity->getCreatedAt(),
            'updated_at' => $serviceEntity->getUpdatedAt(),
            'deleted_at' => $serviceEntity->getDeletedAt(),
        ]);

        return new ServiceEntity(
            id: new Id($row->id),
            establishmentId: $serviceEntity->getEstablishmentId(),
            categoryId: $serviceEntity->getCategoryId(),
            name: $serviceEntity->getName(),
            price: $serviceEntity->getPrice(),
            active: $serviceEntity->getActive(),
            createdAt: $serviceEntity->getCreatedAt(),
            updatedAt: $serviceEntity->getUpdatedAt(),
            deletedAt: $serviceEntity->getDeletedAt()
        );
    }

    public function delete(int $id): bool
    {
        $delete = $this->db::where('id', $id)->delete();

        if ($delete === 0) {
            throw new Exception('Não foi possível excluir esse serviço');
        }

        return true;
    }
}
