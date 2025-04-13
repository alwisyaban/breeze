<?php

namespace App\Providers;

use App\Services\Impl\InspeksiServiceImpl;
use App\Services\InspeksiService;
use Illuminate\Support\ServiceProvider;

class InspeksiProvider extends ServiceProvider
{
    public array $singletons = [
        InspeksiService::class => InspeksiServiceImpl::class
    ];

    public function provides()
    {
        return [InspeksiService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
