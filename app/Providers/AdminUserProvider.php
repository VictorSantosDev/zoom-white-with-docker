<?php

namespace App\Providers;

use App\Domain\Admin\Infrastructure\Entity\UserEntityInterface;
use App\Domain\Admin\Infrastructure\Repository\UserRepositoryInterface;
use App\Infrastructure\Entity\UserEntity;
use App\Infrastructure\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class AdminUserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserEntityInterface::class, UserEntity::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
