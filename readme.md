# Lock User

This package uses [Laravel](https://laravel.com/)'s own authentication system to set a [jQuery](https://jquery.com/) and [Bootstrap](https://getbootstrap.com/docs/5.1/getting-started/introduction/) based timer and view.
You just add the Blade directive to your app's view, set the time in minutes, add the `routes middleware` and it's ready to go.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dr-peter/lock-user.svg?style=flat-square)](https://packagist.org/packages/dr-peter/lock-user)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dr-peter/lock-user/run-tests?label=tests)](https://github.com/dr-peter/lock-user/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dr-peter/lock-user/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dr-peter/lock-user/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dr-peter/lock-user.svg?style=flat-square)](https://packagist.org/packages/dr-peter/lock-user)

## Installation

You can install the package via composer:

```bash
composer require dr-peter/lock-user
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="lock-user-views"
```

### Add to view
All you need to do is to add `@lockUser($time_in_minutes)` to your view. Make sure it is located after jQuery is initialized.

### Routes
The package uses two named routes.
- uri: `lock`, name: `lock-user`
- uri: `unlock`, name: `unlock-user`

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Peter de Rooij](https://github.com/dr-peter)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
