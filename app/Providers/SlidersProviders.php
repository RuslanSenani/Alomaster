<?php

namespace App\Providers;

use App\Contracts\ISlidersRepository;
use App\Repositories\SlidersRepository;
use Illuminate\Support\ServiceProvider;

class SlidersProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ISlidersRepository::class, SlidersRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
