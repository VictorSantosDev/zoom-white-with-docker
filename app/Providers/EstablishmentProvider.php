<?php

namespace App\Providers;

use App\Domain\Establishment\Infrastructure\Entity\EstablishmentEntityInterface;
use App\Domain\Establishment\Infrastructure\Repository\EstablishmentRepositoryInterface;
use App\Infrastructure\Entity\EstablishmentEntity;
use App\Infrastructure\Repository\EstablishmentRepository;
use Illuminate\Support\ServiceProvider;

class EstablishmentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EstablishmentRepositoryInterface::class, EstablishmentRepository::class);
        $this->app->bind(EstablishmentEntityInterface::class, EstablishmentEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
