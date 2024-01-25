<?php

namespace App\Providers;

use App\Domain\Vehicle\Infrastructure\Entity\VehicleEntityInterface;
use App\Domain\Vehicle\Infrastructure\Repository\VehicleRepositoryInterface;
use App\Infrastructure\Entity\VehicleEntity;
use App\Infrastructure\Repository\VehicleRepository;
use Illuminate\Support\ServiceProvider;

class VehicleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VehicleRepositoryInterface::class, VehicleRepository::class);
        $this->app->bind(VehicleEntityInterface::class, VehicleEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
