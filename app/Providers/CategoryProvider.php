<?php

namespace App\Providers;

use App\Domain\Category\Infrastructure\Entity\CategoryEntityInterface;
use App\Domain\Category\Infrastructure\Repository\CategoryRepositoryInterface;
use App\Infrastructure\Entity\CategoryEntity;
use App\Infrastructure\Repository\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class CategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryEntityInterface::class, CategoryEntity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
