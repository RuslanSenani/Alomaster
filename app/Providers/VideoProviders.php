<?php

namespace App\Providers;

use App\Contracts\IVideoRepository;
use App\Repositories\VideoRepository;
use Illuminate\Support\ServiceProvider;

class VideoProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVideoRepository::class, VideoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
