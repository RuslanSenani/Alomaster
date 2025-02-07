<?php

namespace App\Providers;

use App\Contracts\IFrontNewsRepository;
use App\Repositories\FrontNewsRepository;
use Illuminate\Support\ServiceProvider;

class FrontNewsProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IFrontNewsRepository::class, FrontNewsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
