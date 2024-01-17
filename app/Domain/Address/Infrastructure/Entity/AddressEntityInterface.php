<?php

declare(strict_types=1);

namespace App\Domain\Address\Infrastructure\Entity;

use App\Domain\Address\Entity\Address;

interface AddressEntityInterface
{
    public function createAddressEstablishment(Address $address, int $establishmentId): Address;
    public function createAddressCompany(Address $address, int $companyId): Address;
    public function updateAddressEstablishment(Address $address, int $establishmentId): Address;
}
