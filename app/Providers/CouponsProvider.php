<?php

namespace App\Providers;

use App\Domain\Coupons\Infrastructure\Entity\CouponsEntityInterface;
use App\Domain\Coupons\Infrastructure\Repository\CouponsRepositoryInterface;
use App\Infrastructure\Entity\CouponsEntity;
use App\Infrastructure\Repository\CouponsRepository;
use Illuminate\Support\ServiceProvider;

class CouponsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CouponsRepositoryInterface::class, CouponsRepository::class);
        $this->app->bind(CouponsEntityInterface::class, CouponsEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
