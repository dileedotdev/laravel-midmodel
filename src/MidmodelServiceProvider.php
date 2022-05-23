<?php

namespace Dinhdjj\Midmodel;

use Dinhdjj\Midmodel\Commands\MidmodelCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MidmodelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('midmodel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_midmodel_table')
            ->hasCommand(MidmodelCommand::class)
        ;
    }
}
