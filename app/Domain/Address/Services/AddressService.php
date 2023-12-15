<?php

declare(strict_types=1);

namespace App\Domain\Address\Services;

use App\Domain\Address\Entity\Address;
use App\Domain\Address\Infrastructure\Entity\AddressEntityInterface;

class AddressService
{
    public function __construct(
        private AddressEntityInterface $addressEntityInterface
    ) {
    }

    public function create(Address $address, int $establishmentId): Address
    {
        return $this->addressEntityInterface->createAddressEstablishment($address, $establishmentId);
    }
}
