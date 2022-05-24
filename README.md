# A design pattern, a mechanism for performing a set of sync and async actions on the laravel models

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dinhdjj/midmodel.svg?style=flat-square)](https://packagist.org/packages/dinhdjj/midmodel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dinhdjj/midmodel/run-tests?label=tests)](https://github.com/dinhdjj/midmodel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dinhdjj/midmodel/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dinhdjj/midmodel/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dinhdjj/midmodel.svg?style=flat-square)](https://packagist.org/packages/dinhdjj/midmodel)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Requirements

- **PHP 8.1+**
- **Laravel 9+**

## Installation

You can install the package via composer:

```bash
composer require dinhdjj/laravel-midmodel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="midmodel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="midmodel-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * Related to Midmodel model.
     */
    'midmodel' => [
        'model' => \Dinhdjj\Midmodel\Models\Midmodel::class,
        'table' => 'midmodels',
    ],

    /**
     * Related to Action model.
     */
    'action' => [
        'model' => \Dinhdjj\Midmodel\Models\Action::class,
        'table' => 'midmodel_actions',
    ],

    /**
     * Related to ExecutedAction model, The executed action is a given pending/doing/done/failed/error/canceled/... action.
     */
    'executed_action' => [
        'model' => \Dinhdjj\Midmodel\Models\ExecutedAction::class,
        'table' => 'midmodel_executed_actions',
    ],
];
```

## Usage

```php
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [dinhdjj](https://github.com/dinhdjj)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
