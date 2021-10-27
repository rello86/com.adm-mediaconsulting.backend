<?php

namespace Rello86\AdmMediaConsulting;

use Illuminate\Support\ServiceProvider;
use Rello86\AdmMediaConsulting\Console\Commands\PeoplesPlanetsCommand;

class AdmMediaConsultingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.rello86', function () {
            return new PeoplesPlanetsCommand();
        });

        $this->commands(['command.rello86']);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.rello86'];
    }
}
