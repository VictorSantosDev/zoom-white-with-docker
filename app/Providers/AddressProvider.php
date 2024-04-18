<?php

namespace App\Providers;

use App\Domain\Address\Infrastructure\Entity\AddressEntityInterface;
use App\Domain\Address\Infrastructure\Repository\AddressRepositoryInterface;
use App\Infrastructure\Entity\AddressEntity;
use App\Infrastructure\Repository\AddressRepository;
use Illuminate\Support\ServiceProvider;

class AddressProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(AddressEntityInterface::class, AddressEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
