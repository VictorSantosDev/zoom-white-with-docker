<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Infrastructure\Repository\CouponsRepositoryInterface;
use App\Domain\Enum\Active;
use App\Domain\Enum\DaysOfTheWeek;
use App\Models\Coupons as ModelCoupons;
use Exception;

class CouponsRepository implements CouponsRepositoryInterface
{
    public function __construct(
        private ModelCoupons $db
    ) {
    }

    public function getByIdTryFrom(int $id): Coupons
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Cupom não encontrado');
        }

        return new Coupons(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            nameByCompany: $row->name_by_company,
            openingHoursStart: $row->opening_hours_start,
            openingHoursEnd: $row->opening_hours_end,
            daysOfTheWeekStart: DaysOfTheWeek::tryFrom($row->days_of_the_week_start),
            daysOfTheWeekEnd: DaysOfTheWeek::tryFrom($row->days_of_the_week_end),
            info: $row?->info,
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function getByEstablishmentId(int $establishmentId): ?Coupons
    {
        $row = $this->db::where('establishment_id', $establishmentId)->first();

        if (!$row) {
            return null;
        }

        return new Coupons(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            nameByCompany: $row->name_by_company,
            openingHoursStart: $row->opening_hours_start,
            openingHoursEnd: $row->opening_hours_end,
            daysOfTheWeekStart: DaysOfTheWeek::tryFrom($row->days_of_the_week_start),
            daysOfTheWeekEnd: DaysOfTheWeek::tryFrom($row->days_of_the_week_end),
            info: $row?->info,
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
