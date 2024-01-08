<?php

namespace App\Providers;

use App\Domain\WashingVehicleHasWashing\Infrastructure\Entity\WashingVehicleHasWashingEntityInterface;
use App\Domain\WashingVehicleHasWashing\Infrastructure\Repository\WashingVehicleHasWashingRepositoryInterface;
use App\Infrastructure\Entity\WashingVehicleHasWashingEntity;
use App\Infrastructure\Repository\WashingVehicleHasWashingRepository;
use Illuminate\Support\ServiceProvider;

class WashingVehicleHasWashingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WashingVehicleHasWashingRepositoryInterface::class, WashingVehicleHasWashingRepository::class);
        $this->app->bind(WashingVehicleHasWashingEntityInterface::class, WashingVehicleHasWashingEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
