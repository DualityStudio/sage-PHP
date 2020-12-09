<?php

namespace NicolJamie\SagePHP;

use Illuminate\Support\ServiceProvider;

/**
 * Class SageServiceProvider
 * @package NicolJamie\SagePHP
 */
class SageServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sage.php', 'sage');
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        $this->commands([]);
    }
}
