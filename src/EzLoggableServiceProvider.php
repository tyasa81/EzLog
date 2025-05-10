<?php

namespace tyasa81\EzLoggable;

use Carbon\Carbon;
use Generator;
use Illuminate\Support\ServiceProvider;
use tyasa81\EzLoggable\Commands\EzLogClean;

class EzLoggableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //     /*
        //     * Optional methods to load your package assets
        //     */
        //     // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ezloggable');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        //     $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        //     $this->loadViewsFrom(__DIR__.'/../resources/views', 'ezloggable');

        if ($this->app->runningInConsole()) {
            //         $this->publishes([
            //             __DIR__.'/../views' => base_path('resources/views/vendor/ezloggable'),
            //         ], 'ezloggable-views');
            //         $this->publishes([
            //             __DIR__.'/../config/ezloggable.php' => config_path('ezloggable.php'),
            //         ], 'ezloggable-config');

            //         // Publishing the views.
            //         /*$this->publishes([
            //             __DIR__.'/../resources/views' => resource_path('views/vendor/ezloggable'),
            //         ], 'ezloggable-views');*/

            //         // Publishing assets.
            //         /*$this->publishes([
            //             __DIR__.'/../resources/assets' => public_path('vendor/ezloggable'),
            //         ], 'ezloggable-assets');*/

            //         // Publishing the translation files.
            //         /*$this->publishes([
            //             __DIR__.'/../resources/lang' => resource_path('lang/vendor/ezloggable'),
            //         ], 'ezloggable-lang');*/

            // Registering package commands.
            $this->commands([
                EzLogClean::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMigrations(__DIR__.'/../database/migrations');
        //     $this->app->make('Prakash\Todolist\Controllers\TodolistController');
        //     // Automatically apply the package configuration
        //     $this->mergeConfigFrom(__DIR__.'/../config/ezloggable.php', 'ezloggable');

        // Register the main class to use with the facade
        $this->app->singleton(EzLoggable::class, function () {
            return new EzLoggable;
        });
        //     // $this->app->bind('task', function () {
        //     //     return new Task();
        //     // });
    }

    private function registerMigrations(string $directory): void
    {
        if ($this->app->runningInConsole()) {
            $generator = function (string $directory): Generator {
                foreach ($this->app->make('files')->allFiles($directory) as $file) {
                    $to_add = true;
                    $name = null;
                    $add_minutes = 0;
                    if (preg_match('/^\d{4}_\d{2}_\d{2}_(\d{6})_(.*)/', $file->getFilename(), $matches)) {
                        $name = $matches[2];
                        $add_minutes = intval($matches[1]);
                    }

                    foreach ($this->app->make('files')->allFiles($this->app->databasePath('migrations')) as $migrated_file) {
                        if (strpos($migrated_file->getFilename(), $name) !== false) {
                            $to_add = false;
                        }
                    }
                    if ($to_add) {
                        yield $file->getPathname() => $this->app->databasePath(
                            'migrations/'.Carbon::now()->addMinutes($add_minutes)->format('Y_m_d_His').'_'.$name
                        );
                    } else {
                        // echo($file->getFilename() . "\tSkipped\n");
                    }
                }
            };

            $this->publishes(iterator_to_array($generator($directory)), 'ez-migrations');
        }
    }
}
