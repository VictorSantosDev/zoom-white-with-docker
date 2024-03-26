<?php

namespace App\Providers;

use App\Domain\Washing\Infrastructure\Entity\WashingEntityInterface;
use App\Domain\Washing\Infrastructure\Repository\WashingRepositoryInterface;
use App\Infrastructure\Entity\WashingEntity;
use App\Infrastructure\Repository\WashingRepository;
use Illuminate\Support\ServiceProvider;

class WashingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WashingRepositoryInterface::class, WashingRepository::class);
        $this->app->bind(WashingEntityInterface::class, WashingEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
