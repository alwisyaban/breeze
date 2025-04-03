<?php

namespace App\Providers;

use App\Services\Impl\KualifikasiGowningServiceImpl;
use App\Services\KualifikasiGowningService;
use Illuminate\Support\ServiceProvider;

class KualifikasiGowningProvider extends ServiceProvider
{
    public array $singletons = [
        KualifikasiGowningService::class => KualifikasiGowningServiceImpl::class
    ];

    public function provides()
    {
        return [KualifikasiGowningService::class];
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
