<?php

namespace App\Providers;

use App\Contracts\IPortfolioImageRepository;
use App\Repositories\PortfolioImageRepository;
use Illuminate\Support\ServiceProvider;

class PortfolioImagesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPortfolioImageRepository::class, PortfolioImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
