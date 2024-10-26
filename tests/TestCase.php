<?php

namespace tyasa81\EzLoggable\Tests;

use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Sanctum\SanctumServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;
use tyasa81\EzLoggable\EzLoggableServiceProvider;

class TestCase extends Orchestra
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'tyasa81\\EzLoggable\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            // SanctumServiceProvider::class,
            EzLoggableServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');

        /*
        $migration = include __DIR__.'/../database/migrations/create_ezloggable_table.php.stub';
        $migration->up();
        */
    }

    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        tap($app['config'], function (Repository $config) {
            $config->set('app.debug', true);

            // $config->set('database.default', 'testbench');
            // $config->set('database.connections.testbench', [
            //     'driver'   => 'sqlite',
            //     'database' => ':memory:',
            //     'prefix'   => '',
            // ]);

            // // Setup queue database connections.
            // $config([
            //     'queue.batching.database' => 'testbench',
            //     'queue.failed.database' => 'testbench',
            // ]);
        });
    }
}
