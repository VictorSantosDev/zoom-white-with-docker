<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Infrastructure\Entity\CouponsEntityInterface;
use App\Domain\Enum\Active;
use App\Models\Coupons as ModelCoupons;

class CouponsEntity implements CouponsEntityInterface
{
    public function __construct(
        private ModelCoupons $db
    ) {
    }

    public function create(Coupons $coupons): Coupons
    {
        $row = $this->db::create([
            'establishment_id' => $coupons->getEstablishmentId()->get(),
            'name_by_company' => $coupons->getNameByCompany(),
            'opening_hours_start' => $coupons->getOpeningHoursStart(),
            'opening_hours_end' => $coupons->getOpeningHoursEnd(),
            'days_of_the_week_start' => $coupons->getDaysOfTheWeekStart(),
            'days_of_the_week_end' => $coupons->getDaysOfTheWeekEnd(),
            'info' => $coupons->getInfo(),
            'active' => $coupons->getActive(),
            'created_at' => $coupons->getCreatedAt(),
            'updated_at' => $coupons->getUpdatedAt(),
            'deleted_at' => $coupons->getDeletedAt(),
        ]);

        return new Coupons(
            id: new Id($row->id),
            establishmentId: $coupons->getEstablishmentId(),
            nameByCompany: $coupons->getNameByCompany(),
            openingHoursStart: $coupons->getOpeningHoursStart(),
            openingHoursEnd: $coupons->getOpeningHoursEnd(),
            daysOfTheWeekStart: $coupons->getDaysOfTheWeekStart(),
            daysOfTheWeekEnd: $coupons->getDaysOfTheWeekEnd(),
            info: $coupons->getInfo(),
            active: $coupons->getActive(),
            createdAt: $coupons->getCreatedAt(),
            updatedAt: $coupons->getUpdatedAt(),
            deletedAt: $coupons->getDeletedAt(),
        );
    }

    public function update(Coupons $coupons): Coupons
    {
        $row = $this->db::where('id', $coupons->getId()->get())->first();

        $row->name_by_company = $coupons->getNameByCompany();
        $row->opening_hours_start = $coupons->getOpeningHoursStart();
        $row->opening_hours_end = $coupons->getOpeningHoursEnd();
        $row->days_of_the_week_start = $coupons->getDaysOfTheWeekStart();
        $row->days_of_the_week_end = $coupons->getDaysOfTheWeekEnd();
        $row->info = $coupons->getInfo();
        $row->updated_at = $coupons->getUpdatedAt();
        $row->save();

        return new Coupons(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            nameByCompany: $coupons->getNameByCompany(),
            openingHoursStart: $coupons->getOpeningHoursStart(),
            openingHoursEnd: $coupons->getOpeningHoursEnd(),
            daysOfTheWeekStart: $coupons->getDaysOfTheWeekStart(),
            daysOfTheWeekEnd: $coupons->getDaysOfTheWeekEnd(),
            info: $coupons->getInfo(),
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $coupons->getUpdatedAt(),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function enableOrDisable(int $id, int $active): bool
    {
        $row = $this->db::where('id', $id)->first();

        $row->active = $active;
        $row->updated_at = now();
        $row->save();

        return true;
    }
}
