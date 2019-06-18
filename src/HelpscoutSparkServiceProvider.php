<?php

namespace KeithBrink\HelpscoutSpark;

use Illuminate\Support\ServiceProvider;

class HelpscoutSparkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/helpscout-spark.php' => config_path('helpscout-spark.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'helpscout-spark');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/helpscout-spark.php', 'helpscout-spark'
        );

        $this->app->register(\HelpScout\Laravel\HelpScoutServiceProvider::class);
    }
}
