<?php

namespace App\Providers;

use App\Domain\Permissions\Infrastructure\Repository\PermissionsRepositoryInterface;
use App\Infrastructure\Repository\PermissionsRepository;
use Illuminate\Support\ServiceProvider;

class PermissionsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PermissionsRepositoryInterface::class, PermissionsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
