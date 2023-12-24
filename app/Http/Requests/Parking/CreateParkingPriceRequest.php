<?php

namespace App\Http\Requests\Parking;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\ParkingPrice\Entity\ParkingPrice;
use Illuminate\Foundation\Http\FormRequest;

class CreateParkingPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'priceDaily' => 'required|integer',
            'priceByHour' => 'required|integer',
            'chargeEveryHour' => 'required|integer|max_digits:2',
            'pricePerHour' => 'required|integer',
            'hasOtherNightPrice' => 'required|boolean',
            'priceByHourNight' => 'required_if:has_other_night_price,true|integer',
            'startOfAdditional' => 'required_if:has_other_night_price,true|string',
            'endOfAdditional' => 'required_if:has_other_night_price,true|string'
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute deve receber um valor númerico',
            'required' => 'O campo :attribute é obrigatório',
            'required_if' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute só aceita texto',
            'max_digits' => 'O campo :attribute aceita no máximo :max_digits caracteres',
        ];
    }

    public function data()
    {
        return new ParkingPrice(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            priceDaily: $this->input('priceDaily'),
            priceByHour: $this->input('priceByHour'),
            chargeEveryHour: $this->input('chargeEveryHour'),
            pricePerHour: $this->input('pricePerHour'),
            hasOtherNightPrice: $this->input('hasOtherNightPrice'),
            priceByHourNight: $this->input('priceByHourNight'),
            startOfAdditional: $this->input('startOfAdditional'),
            endOfAdditional: $this->input('endOfAdditional'),
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }
}
