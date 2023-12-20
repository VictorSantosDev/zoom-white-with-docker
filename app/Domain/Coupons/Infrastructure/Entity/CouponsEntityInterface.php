<?php

namespace App\Domain\Coupons\Infrastructure\Entity;

use App\Domain\Coupons\Entity\Coupons;

interface CouponsEntityInterface
{
    public function create(Coupons $coupons): Coupons;
    public function update(Coupons $coupons): Coupons;
    public function enableOrDisable(int $id, int $active): bool;
}
