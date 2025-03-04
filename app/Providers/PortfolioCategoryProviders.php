<?php

namespace App\Providers;

use App\Contracts\IPortfolioCategoryRepository;
use App\Repositories\PortfoliosCategories;
use Illuminate\Support\ServiceProvider;

class PortfolioCategoryProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPortfolioCategoryRepository::class, PortfoliosCategories::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
