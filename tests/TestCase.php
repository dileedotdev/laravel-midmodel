<?php

namespace Dinhdjj\Midmodel\Tests;

use Dinhdjj\Midmodel\MidmodelServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Dinhdjj\\Midmodel\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            MidmodelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/create_account_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_midmodel_tables.php.stub';
        $migration->up();
    }
}
