<?php

namespace App\Providers;

use App\Domain\Employee\Infrastructure\Entity\EmployeeEntityInterface;
use App\Domain\Employee\Infrastructure\Repository\EmployeeRepositoryInterface;
use App\Infrastructure\Entity\EmployeeEntity;
use App\Infrastructure\Repository\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class EmployeeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeEntityInterface::class, EmployeeEntity::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
