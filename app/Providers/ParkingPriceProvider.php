<?php

namespace App\Providers;

use App\Domain\ParkingPrice\Infrastructure\Entity\ParkingPriceEntityInterface;
use App\Domain\ParkingPrice\Infrastructure\Repository\ParkingPriceRepositoryInterface;
use App\Infrastructure\Entity\ParkingPriceEntity;
use App\Infrastructure\Repository\ParkingPriceRepository;
use Illuminate\Support\ServiceProvider;

class ParkingPriceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ParkingPriceRepositoryInterface::class, ParkingPriceRepository::class);
        $this->app->bind(ParkingPriceEntityInterface::class, ParkingPriceEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
