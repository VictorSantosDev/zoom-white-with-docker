<?php

namespace App\Providers;

use App\Domain\UserHasPermission\Infrastructure\Entity\UserHasPermissionEntityInterface;
use App\Domain\UserHasPermission\Infrastructure\Repository\UserHasPermissionRepositoryInterface;
use App\Infrastructure\Entity\UserHasPermissionEntity;
use App\Infrastructure\Repository\UserHasPermissionRepository;
use Illuminate\Support\ServiceProvider;

class UserHasPermissionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserHasPermissionEntityInterface::class, UserHasPermissionEntity::class);
        $this->app->bind(UserHasPermissionRepositoryInterface::class, UserHasPermissionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
