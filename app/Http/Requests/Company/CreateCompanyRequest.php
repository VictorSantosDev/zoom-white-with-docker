<?php

namespace App\Http\Requests\Company;

use App\Domain\Address\Entity\Address;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Company\Entity\Company;
use App\Domain\Enum\Active;
use App\Utils\Permissions\CheckPermission;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CheckPermission::checkPermission('api_create_company');
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'companyName' => 'required|string|max:150',
            'fantasyName' => 'nullable|string|max:150',
            'document' => 'required|cpf_ou_cnpj',
            'phone' => 'required|min:11|max:11',
            'email' => 'email|max:255',
            'closingDate' => 'required|integer|between:0,31',
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
            'string' => 'O campo :attribute deve ser do tipo texto',
            'date' => 'O campo :attribute deve ser uma data válida no formato 0000-00-00'
        ];
    }

    public function dataCompany(): Company
    {
        return new Company(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            companyName: $this->input('companyName'),
            fantasyName: $this->input('fantasyName'),
            document: $this->input('document'),
            phone: $this->input('phone'),
            email: $this->input('email'),
            closingDate: $this->input('closingDate'),
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }

    public function dataAddress(): Address
    {
        return new Address(
            id: null,
            userId: null,
            establishmentId: null,
            companyId: null,
            postalCode: $this->input('address.postalCode'),
            street: $this->input('address.street'),
            neighborhood: $this->input('address.neighborhood'),
            state: $this->input('address.state'),
            city: $this->input('address.city'),
            number: $this->input('address.number'),
            complement: $this->input('address.complement'),
            active: Active::ACTIVE,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }
}
