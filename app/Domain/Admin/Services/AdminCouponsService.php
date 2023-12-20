<?php

namespace App\Domain\Admin\Services;

use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Services\CouponsService;

class AdminCouponsService
{
    public function __construct(
        private CouponsService $couponsService
    ) {
    }

    public function create(Coupons $coupons): Coupons
    {
        return $this->couponsService->create($coupons);
    }

    public function update(Coupons $coupons): Coupons
    {
        return $this->couponsService->update($coupons);
    }

    public function show(int $id): Coupons
    {
        return $this->couponsService->show($id);
    }

    public function enableOrDisable(int $id, int $active): bool
    {
        return $this->couponsService->enableOrDisable($id, $active);
    }
}
