<?php

namespace App\Providers;

use App\Contracts\IPortfoliosRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Support\ServiceProvider;

class PortfoliosProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPortfoliosRepository::class, PortfoliosRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
