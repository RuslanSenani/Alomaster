<?php

namespace App\Providers;

use App\Contracts\IImageRepository;
use App\Repositories\ImageRepository;
use Illuminate\Support\ServiceProvider;

class ImagesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IImageRepository::class, ImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
