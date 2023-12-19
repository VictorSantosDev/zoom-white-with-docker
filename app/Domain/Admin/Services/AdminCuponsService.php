<?php

namespace App\Domain\Admin\Services;

use App\Domain\Coupons\Entity\Coupons;
use App\Domain\Coupons\Services\CouponsService;

class AdminCuponsService
{
    public function __construct(
        private CouponsService $couponsService
    ) {
    }

    public function create(Coupons $coupons): Coupons
    {
        return $this->couponsService->create($coupons);
    }

    public function update()
    {
    }

    public function show()
    {
    }

    public function delete()
    {
    }
}
