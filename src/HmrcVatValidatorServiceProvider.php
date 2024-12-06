<?php

namespace AmitPatel\HmrcVatValidator;

use Illuminate\Support\ServiceProvider;

class HmrcVatValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/hmrcvatvalidator.php', 'hmrcvatvalidator');

        $this->app->singleton(HmrcVatValidatorService::class, function () {
            return new HmrcVatValidatorService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/hmrcvatvalidator.php' => config_path('hmrcvatvalidator.php'),
        ], 'config');
    }
}