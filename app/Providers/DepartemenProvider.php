<?php

namespace App\Providers;

use App\Services\DepartemenService;
use App\Services\Impl\DepartemenServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DepartemenProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        DepartemenService::class => DepartemenServiceImpl::class
    ];

    public function provides()
    {
        return [DepartemenService::class];
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
