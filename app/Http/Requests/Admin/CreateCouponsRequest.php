<?php

namespace App\Http\Requests\Admin;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Enum\DaysOfTheWeek;
use Illuminate\Foundation\Http\FormRequest;

class CreateCouponsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishmentId' => 'required|integer',
            'nameByCompany' => 'required|string',
            'openingHoursStart' => 'required|string',
            'openingHoursEnd' => 'required|string',
            'daysOfTheWeekStart' => 'required|in:' . DaysOfTheWeek::MONDAY->value
                . ',' . DaysOfTheWeek::THIRD->value
                . ',' . DaysOfTheWeek::WEDNESDAY->value
                . ',' . DaysOfTheWeek::THURSDAY->value
                . ',' . DaysOfTheWeek::FRIDAY->value
                . ',' . DaysOfTheWeek::SATURDAY->value
                . ',' . DaysOfTheWeek::SUNDAY->value,
            'daysOfTheWeekEnd' => 'required|in:' . DaysOfTheWeek::MONDAY->value
                . ',' . DaysOfTheWeek::THIRD->value
                . ',' . DaysOfTheWeek::WEDNESDAY->value
                . ',' . DaysOfTheWeek::THURSDAY->value
                . ',' . DaysOfTheWeek::FRIDAY->value
                . ',' . DaysOfTheWeek::SATURDAY->value
                . ',' . DaysOfTheWeek::SUNDAY->value,
            'info' => 'nullable|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => 'O campo :attribute aceita somente números inteiros',
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute aceita no máximo :max caracteres',
            'in' => 'O campo :attribute só aceita esses valores THIRD, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY e SUNDAY',
        ];
    }

    public function data(): Coupons
    {
        return new Coupons(
            id: null,
            establishmentId: new Id($this->input('establishmentId')),
            nameByCompany: $this->input('nameByCompany'),
            openingHoursStart: $this->input('openingHoursStart'),
            openingHoursEnd: $this->input('openingHoursEnd'),
            daysOfTheWeekStart: DaysOfTheWeek::tryFrom($this->input('daysOfTheWeekStart')),
            daysOfTheWeekEnd: DaysOfTheWeek::tryFrom($this->input('daysOfTheWeekEnd')),
            info: $this->input('info', null),
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }
}
