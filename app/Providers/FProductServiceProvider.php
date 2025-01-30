<?php

namespace App\Providers;

use App\Contracts\IFProductRepository;
use App\Repositories\FProductRepository;
use Illuminate\Support\ServiceProvider;

class FProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IFProductRepository::class,FProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
