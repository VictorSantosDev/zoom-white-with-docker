<?php

namespace App\Providers;

use App\Domain\WashingVehicle\Infrastructure\Entity\WashingVehicleEntityInterface;
use App\Domain\WashingVehicle\Infrastructure\Repository\WashingVehicleRepositoryInterface;
use App\Infrastructure\Entity\WashingVehicleEntity;
use App\Infrastructure\Repository\WashingVehicleRepository;
use Illuminate\Support\ServiceProvider;

class WashingVehicleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WashingVehicleRepositoryInterface::class, WashingVehicleRepository::class);
        $this->app->bind(WashingVehicleEntityInterface::class, WashingVehicleEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
