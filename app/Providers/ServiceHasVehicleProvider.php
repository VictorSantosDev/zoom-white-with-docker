<?php

namespace App\Providers;

use App\Domain\ServiceHasVehicle\Infrastructure\Entity\ServiceHasVehicleEntityInterface;
use App\Domain\ServiceHasVehicle\Infrastructure\Repository\ServiceHasVehicleRepositoryInterface;
use App\Infrastructure\Entity\ServiceHasVehicleEntity;
use App\Infrastructure\Repository\ServiceHasVehicleRepository;
use Illuminate\Support\ServiceProvider;

class ServiceHasVehicleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceHasVehicleRepositoryInterface::class, ServiceHasVehicleRepository::class);
        $this->app->bind(ServiceHasVehicleEntityInterface::class, ServiceHasVehicleEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
