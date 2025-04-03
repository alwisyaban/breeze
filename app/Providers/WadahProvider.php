<?php

namespace App\Providers;

use App\Services\Impl\WadahServiceImpl;
use App\Services\WadanService;
use Illuminate\Support\ServiceProvider;

class WadahProvider extends ServiceProvider
{
    public array $singletons = [
        WadanService::class => WadahServiceImpl::class
    ];

    public function provides()
    {
        return [WadanService::class];
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
