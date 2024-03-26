<?php

namespace App\Domain\User\Services;

use App\Domain\Service\Services\ServiceMain;

use App\Domain\Service\Entity\ServiceEntity;

class UserServiceByCategoryService
{
    public function __construct(
        private ServiceMain $serviceMain
    ) {
    }

    public function create(ServiceEntity $serviceEntity): ServiceEntity
    {
        return $this->serviceMain->create($serviceEntity);
    }

    public function show(int $id): ServiceEntity
    {
        return $this->serviceMain->show($id);
    }

    public function list(
        int $establishmentId,
        ?int $categoryId,
        ?string $name,
        ?int $price,
        ?int $limitPerPage
    ): array {
        return $this->serviceMain->list(
            $establishmentId,
            $categoryId,
            $name,
            $price,
            $limitPerPage
        );
    }

    public function delete(int $id): bool
    {
        return $this->serviceMain->delete($id);
    }
}
