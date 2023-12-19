<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Infrastructure\Entity\CouponsEntityInterface;
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
            createdAt: $coupons->getCreatedAt(),
            updatedAt: $coupons->getUpdatedAt(),
            deletedAt: $coupons->getDeletedAt(),
        );
    }
}
