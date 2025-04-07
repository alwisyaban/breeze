<?php

namespace App\Providers;

use App\Services\Impl\SediaanServiceImpl;
use App\Services\SediaanService;
use Illuminate\Support\ServiceProvider;

class SediaanProvider extends ServiceProvider
{
    public array $singletons = [
        SediaanService::class => SediaanServiceImpl::class
    ];

    public function provides()
    {
        return [SediaanService::class];
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
