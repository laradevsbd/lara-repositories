<?php

namespace Laradevsbd\Repository;

use Illuminate\Support\ServiceProvider;
use Laradevsbd\Repository\Console\MakeRepository;

class LaradevsbdRepositoryServiceProvider extends ServiceProvider{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepository::class
            ]);
        }
        $this->publishes([
            __DIR__.'/Repositories/BaseRepository.php'=>app_path('Repositories/BaseRepository.php')
        ]);
    }

    public function register()
    {

    }

}
