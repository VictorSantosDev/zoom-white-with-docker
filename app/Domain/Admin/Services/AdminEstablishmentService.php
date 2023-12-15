<?php

namespace App\Domain\Admin\Services;

use App\Domain\Address\Entity\Address;
use App\Domain\Address\Services\AddressService;
use App\Domain\Establishment\Entity\Establishment;
use App\Domain\Establishment\Services\EstablishmentService;

class AdminEstablishmentService
{
    public function __construct(
        private EstablishmentService $establishmentService,
        private AdminUserService $adminUserService,
        private AddressService $addressService
    ) {
    }

    public function create(
        Establishment $establishment,
        Address $address
    ): array {
        $user = $this->adminUserService->findUserById($establishment->getUserId()->get());

        $establishmentCreated = $this->establishmentService->create($establishment);

        $addressCreated = $this->addressService->create(
            $address,
            $establishmentCreated->getId()->get()
        );

        return [
            'establishment' => $establishmentCreated->jsonSerialize(),
            'address' => $addressCreated->jsonSerialize(),
        ];
    }

    public function listByUserId(
        int $userId,
        ?string $nameByCompany,
        ?string $document,
        ?string $type
    ): array {
        $user = $this->adminUserService->findUserById($userId);

        return $this->establishmentService->listEstablishmentByUserId(
            $user->getId()->get(),
            $nameByCompany,
            $document,
            $type
        );
    }

    public function show(int $id): Establishment
    {
        return $this->establishmentService->show($id);
    }
}
