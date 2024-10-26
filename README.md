# This is my package ezloggable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tyasa81/ezloggable.svg?style=flat-square)](https://packagist.org/packages/tyasa81/ezloggable)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tyasa81/ezloggable/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tyasa81/ezloggable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tyasa81/ezloggable/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tyasa81/ezloggable/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tyasa81/ezloggable.svg?style=flat-square)](https://packagist.org/packages/tyasa81/ezloggable)

To log changes in your models.

## Installation

You can install the package via composer:

```bash
composer require tyasa81/ezloggable
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="ez-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ezloggable-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$log = EzLog::log(
    user_id: 88,
    loggable_type: "stock",
    loggable_id: 96,
    acted_by_type: "user",
    acted_by_id: 5,
    action: "set",
    column: "qty",
    before: 5,
    after: 10,
);
```

## Testing

```bash
vendor/bin/testbench package:create-sqlite-db
vendor/bin/testbench vendor:publish
vendor/bin/testbench migrate
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tony Yasa](https://github.com/tyasa81)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
