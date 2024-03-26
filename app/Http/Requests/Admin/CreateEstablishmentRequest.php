<?php

namespace App\Http\Requests\Admin;

use App\Domain\Address\Entity\Address;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeEstablishment;
use App\Domain\Establishment\Entity\Establishment;
use Illuminate\Foundation\Http\FormRequest;

class CreateEstablishmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'required|integer',
            'nameByCompany' => 'required|max:255',
            'document' => 'cpf_ou_cnpj',
            'type' =>
            'in:' . TypeEstablishment::CAR_WASH->value .
                ','   . TypeEstablishment::PARKING->value .
                ','   . TypeEstablishment::CAR_WASH_AND_PARKING->value,
            'corSystem' => 'required|max:50',
            'address.postalcode' => 'required|max:8|min:8',
            'address.street' => 'required|max:255',
            'address.neighborhood' => 'required|max:255',
            'address.state' => 'required|max:2|min:2',
            'address.city' => 'required|max:255',
            'address.number' => 'required|max:100',
            'address.complement' => 'max:100|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'cpf_ou_cnpj' => 'O documento CPF ou CNPJ é inválido',
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute aceita no máximo :max caracteres',
            'min' => 'O campo :attribute aceita no minímo :min caracteres',
            'type.in' => 'O campo type só aceita esses valores CAR_WASH, PARKING, CAR_WASH_AND_PARKING',
        ];
    }

    public function dataEstablishment(): Establishment
    {
        return new Establishment(
            id: null,
            userId: new Id($this->input('userId')),
            nameByCompany: $this->input('nameByCompany'),
            document: $this->input('document'),
            type: TypeEstablishment::tryFrom($this->input('type')),
            corSystem: $this->input('corSystem'),
            pathLogo: null,
            active: Active::ACTIVE,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }

    public function dataAddress(): Address
    {
        return new Address(
            id: null,
            userId: null,
            establishmentId: null,
            companyId: null,
            postalCode: $this->input('address.postalcode'),
            street: $this->input('address.street'),
            neighborhood: $this->input('address.neighborhood'),
            state: $this->input('address.state'),
            city: $this->input('address.city'),
            number: $this->input('address.number'),
            complement: $this->input('address.complement'),
            active: Active::ACTIVE,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }
}
