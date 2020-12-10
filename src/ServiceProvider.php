<?php

namespace NicolJamie\Sage;

use Illuminate\Support\ServiceProvider as BaseProvider;

/**
 * Class ServiceProvider
 * @package NicolJamie\Sage
 */
class ServiceProvider extends BaseProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/sage.php' => config_path('sage.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
