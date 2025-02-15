<?php

namespace App\Providers;

use App\Contracts\IGalleryRepository;
use App\Repositories\GalleryRepository;
use Illuminate\Support\ServiceProvider;

class GalleryProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IGalleryRepository::class, GalleryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
