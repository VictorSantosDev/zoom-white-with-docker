<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Address\Entity\Address;
use App\Domain\Address\Infrastructure\Entity\AddressEntityInterface;
use App\Domain\Admin\ValueObjects\Id;
use App\Models\Address as EntityAddress;
use Exception;

class AddressEntity implements AddressEntityInterface
{
    public function __construct(
        private EntityAddress $db
    ) {
    }

    public function createAddressEstablishment(Address $address, int $establishmentId): Address
    {
        $row = $this->db::create([
            'user_id' => $address->getUserId()?->get(),
            'establishment_id' => $establishmentId,
            'postal_code' => $address->getPostalCode(),
            'street' => $address->getStreet(),
            'neighborhood' => $address->getNeighborhood(),
            'state' => $address->getState(),
            'city' => $address->getCity(),
            'number' => $address->getNumber(),
            'complement' => $address->getComplement(),
            'active' => $address->getActive()->value,
            'created_at' => $address->getCreatedAt(),
            'updated_at' => $address->getUpdatedAt(),
            'deleted_at' => $address->getDeletedAt(),
        ]);

        return new Address(
            id: new Id($row->id),
            userId: $address->getUserId(),
            establishmentId: new Id($establishmentId),
            postalCode: $address->getPostalCode(),
            street: $address->getStreet(),
            neighborhood: $address->getNeighborhood(),
            state: $address->getState(),
            city: $address->getCity(),
            number: $address->getNumber(),
            complement: $address->getComplement(),
            active: $address->getActive(),
            createdAt: $address->getCreatedAt(),
            updatedAt: $address->getUpdatedAt(),
            deletedAt: $address->getDeletedAt(),
        );
    }

    public function updateAddressEstablishment(Address $address, int $establishmentId): Address
    {
        $row = $this->db::where('establishment_id', $establishmentId)->first();

        if (!$row) {
            throw new Exception('Não foi encontrado endereço para esse estabelecimento');
        }

        $row->postal_code = $address->getPostalCode();
        $row->street = $address->getStreet();
        $row->neighborhood = $address->getNeighborhood();
        $row->state = $address->getState();
        $row->city = $address->getCity();
        $row->number = $address->getNumber();
        $row->complement = $address->getComplement();
        $row->updated_at = $address->getUpdatedAt();
        $row->save();

        return new Address(
            id: new Id($row->id),
            userId: $address->getUserId(),
            establishmentId: new Id($establishmentId),
            postalCode: $address->getPostalCode(),
            street: $address->getStreet(),
            neighborhood: $address->getNeighborhood(),
            state: $address->getState(),
            city: $address->getCity(),
            number: $address->getNumber(),
            complement: $address->getComplement(),
            active: $address->getActive(),
            createdAt: $address->getCreatedAt(),
            updatedAt: $address->getUpdatedAt(),
            deletedAt: $address->getDeletedAt(),
        );
    }
}
