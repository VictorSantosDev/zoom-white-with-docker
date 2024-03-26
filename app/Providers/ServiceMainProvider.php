<?php

namespace App\Providers;

use App\Domain\Service\Infrastructure\Entity\ServiceEntityInterface;
use App\Domain\Service\Infrastructure\Repository\ServiceRepositoryInterface;
use App\Infrastructure\Entity\ServiceEntityDB;
use App\Infrastructure\Repository\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class ServiceMainProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ServiceEntityInterface::class, ServiceEntityDB::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
