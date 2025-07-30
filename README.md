# Laravel 12 Starter Kit

A Laravel 12 starter kit with opinionated defaults for rapid development.

## Features

This starter kit comes pre-configured with:

- **Laravel Breeze** - Simple authentication scaffolding
- **Laravel Pint** - Opinionated PHP code style fixer
- **Larastan** - Static analysis tool for Laravel applications  
- **Rector** - Automated code refactoring and upgrades
- **Pest** - Modern PHP testing framework
- **Strict Types** - Enabled across all PHP files
- **PHP 8.3** - Latest PHP version with modern features

## Quick Start

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start development server: `php artisan serve`

## Development Tools

### Code Quality
- **Pint**: `composer run pint` - Format code according to Laravel standards
- **Larastan**: `composer run analyse` - Run static analysis
- **Rector**: `vendor/bin/rector process` - Automated refactoring

### Testing
- **Pest**: `composer run test` - Run the test suite
- **Coverage**: `composer run test-coverage` - Generate test coverage report

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
