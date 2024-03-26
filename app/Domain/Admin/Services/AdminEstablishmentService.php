<?php

declare(strict_types=1);

namespace App\Domain\Admin\Services;

use App\Domain\Address\Entity\Address;
use App\Domain\Address\Services\AddressService;
use App\Domain\Employee\Services\EmployeeService;
use App\Domain\Establishment\Entity\Establishment;
use App\Domain\Establishment\Services\EstablishmentService;

class AdminEstablishmentService
{
    public function __construct(
        private EstablishmentService $establishmentService,
        private AdminUserService $adminUserService,
        private AddressService $addressService,
        private EmployeeService $employeeService
    ) {
    }

    public function create(
        Establishment $establishment,
        Address $address
    ): array {
        $this->adminUserService->findUserById($establishment->getUserId()->get());

        $establishmentCreated = $this->establishmentService->create($establishment);

        $addressCreated = $this->addressService->create(
            $address,
            $establishmentCreated->getId()->get()
        );

        /** @not used createEmployee */
        // $this->employeeService->createEmployeeAdmin($user, $establishmentCreated->getId());

        return [
            'establishment' => $establishmentCreated->jsonSerialize(),
            'address' => $addressCreated->jsonSerialize(),
        ];
    }

    public function update(
        Establishment $establishment,
        Address $address
    ): array {
        $establishmentUpdated = $this->establishmentService->update($establishment);
        $addressUpdated = $this->addressService->updateByEstablishment(
            $address,
            $establishmentUpdated->getId()->get()
        );

        return [
            'establishment' => $establishmentUpdated->jsonSerialize(),
            'address' => $addressUpdated->jsonSerialize(),
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

    public function show(int $id): array
    {
        return $this->establishmentService->show($id);
    }

    public function delete(int $id): bool
    {
        return $this->establishmentService->delete($id);
    }
}
