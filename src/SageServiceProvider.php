<?php

namespace NicolJamie\SagePHP;

use Illuminate\Support\ServiceProvider;
use InvoiceRequest;

/**
 * Class SageServiceProvider
 * @package Fcp\AnimalBreedsSearch
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
        $this->register();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(InvoiceRequest::class, function ($app) {
            return new InvoiceRequest();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/sage.php', 'sage');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
