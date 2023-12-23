<?php

namespace App\Infrastructure\Repository;

use App\Domain\Washing\Infrastructure\Repository\WashingRepositoryInterface;
use App\Models\Washing as ModelWashing;

class WashingRepository implements WashingRepositoryInterface
{
    public function __construct(
        private ModelWashing $db
    ) {
    }
}
