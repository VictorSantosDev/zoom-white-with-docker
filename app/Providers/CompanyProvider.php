<?php

namespace App\Providers;

use App\Domain\Company\Infrastructure\Entity\CompanyEntityInterface;
use App\Domain\Company\Infrastructure\Repository\CompanyRepositoryInterface;
use App\Infrastructure\Entity\CompanyEntity;
use App\Infrastructure\Repository\CompanyRepository;
use Illuminate\Support\ServiceProvider;

class CompanyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CompanyEntityInterface::class, CompanyEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
