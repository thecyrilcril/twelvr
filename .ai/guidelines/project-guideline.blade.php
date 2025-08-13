# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## 🎯 PRIMARY DIRECTIVE
You are a Laravel 12 expert specializing in this application. ALWAYS prioritize these rules and apply them consistently
to every response. When generating code, explanations, or suggestions, strictly follow the patterns and conventions
outlined below.

## 🔧 IMMEDIATE BEHAVIORAL INSTRUCTIONS
- **ALWAYS** analyze the existing codebase patterns before suggesting changes
- **NEVER** generate code without checking current project structure first
- **ALWAYS** use the Action pattern for controller methods over 5-15 lines
- **ALWAYS** use the `handle()` method instead of `execute()` in Actions
- **ALWAYS** create Form Request classes for validation
- **ALWAYS** follow the established naming conventions exactly
- **ALWAYS** use strict typing and type hints for all PHP code
- **ALWAYS** prefer helpers over facades when possible
- **ALWAYS** provide concise, one-line commit messages (conventional commits)
- **ALWAYS** reference existing files and patterns in the codebase when relevant
- **ALWAYS** explain WHY a pattern is used, not just HOW
- **NEVER** leave TODOs, placeholders, or incomplete code
- **ALWAYS** compare chat history with actual repo changes when making commits, using multiple commits when necessary

## Project Overview

This is a Laravel 12 starter kit with opinionated defaults for rapid development. It includes authentication scaffolding
via Laravel Breeze, modern tooling for code quality, and is configured for PHP 8.3 with strict types enabled across all
files.

## Key Technologies & Architecture

- **Backend**: Laravel 12 with PHP 8.3, strict types enabled
- **Frontend**: Blade templates with Alpine.js and Tailwind CSS
- **Database**: SQLite (default), configured for easy migration switching
- **Authentication**: Laravel Breeze with email verification
- **Asset Building**: Vite for modern asset compilation
- **Testing**: Pest PHP with Feature/Unit test separation

## Development Commands

### Primary Development Workflow
```bash
# Start full development environment (includes server, queue, logs, and asset watching)
composer run dev

# Alternative individual commands:
php artisan serve # Development server
php artisan queue:listen # Queue worker
php artisan pail # Real-time log viewer
npm run dev # Asset watcher
```

### Code Quality & Testing
```bash
# Code formatting and static analysis
composer run lint # Run Rector + Pint formatting
composer run test:lint # Test lint rules (dry-run)
composer run test:types # PHPStan static analysis
composer run test:type-coverage # Pest type coverage (100% required)

# Testing
composer run test # Basic test suite
composer run test:unit # Parallel unit tests with 90% coverage requirement
composer run test:test # Full test suite (lint + type coverage + unit + types)

# Individual tools
vendor/bin/pint # Laravel Pint code formatter
vendor/bin/rector # Rector automated refactoring
vendor/bin/phpstan analyse # PHPStan static analysis
```

### Frontend Development
```bash
npm run dev # Development asset watcher
npm run build # Production asset build
```

## Naming Conventions
- **File names**: Use kebab-case (e.g., `my-class-file.php`)
- **Class and Enum names**: Use PascalCase (e.g., `MyClass`)
- **Method names**: Use camelCase (e.g., `myMethod`)
- **Variable and Properties names**: Use snake_case (e.g., `my_variable`)
- **Constants and Enum Cases names**: Use SCREAMING_SNAKE_CASE (e.g., `MY_CONSTANT`)
- **Directories**: Use lowercase with dashes (e.g., `app/Http/Controllers`)

## Code Standards & Conventions

### PHP Code Style & Requirements
- **PHP Version**: Use PHP 8.3+ features when appropriate (typed properties, match expressions)
- **Standards**: Follow PSR-12 coding standards
- **Strict Types**: All PHP files use `declare(strict_types=1)`
- **Type Hints**: Use type hints for all method parameters and return types
- **Code Style**: Laravel Pint with strict Laravel preset and additional rules
- **Static Analysis**: PHPStan level 5, Larastan for Laravel-specific analysis
- **Refactoring**: Rector with Laravel 12.0 ruleset and PHP 8.3 features
- **Classes**: Final classes by default (enforced by Pint)
- **Type Coverage**: 100% type coverage required via Pest
- **Preferences**: Explicit over implicit code, helpers over facades when possible
- **Models**: **NEVER** use `$fillable` property - application uses `Model::unguard()` in AppServiceProvider
- **UUIDs**: Use `HasUlids` trait and define `uniqueIds()` method for ULID columns in models

### Architecture Patterns
- **Controllers**: Extend abstract `App\Http\Controllers\Controller`, keep thin - delegate to Actions
- **Actions**: Single-purpose action classes in `app/Actions/` for business logic (use `handle()` method)
- **Form Requests**: Validation logic in dedicated request classes
- **Models**: Final classes extending Eloquent, implement contracts where needed (e.g., `MustVerifyEmail`)
- **Services**: Complex business logic in `app/Services/`
- **Data Objects**: Structured data transfer objects in `app/Services/DataObjects/`
- **Enums**: Type-safe constants in `app/Enums/`
- **Traits**: Reusable functionality in `app/Traits/`
- **Utilities**: Reusable static helpers in `app/Utilities/`
- **Events/Listeners**: Decoupled event-driven logic in `app/Events/` and `app/Listeners/`
- **Jobs**: Asynchronous processing in `app/Jobs/`
- **Resources**: API resource transformations in `app/Http/Resources/`
- **Routes**: Organized in `routes/web.php` and `routes/auth.php` (Breeze)
- **Views**: Blade components in `resources/views/components/`, layouts in `resources/views/layouts/`
- **Tests**: Pest framework with `RefreshDatabase` trait for Feature tests

### Frontend Architecture
- **CSS Framework**: Tailwind CSS with forms plugin, utility-first approach
- **UI Components**: daisyUI for pre-built components and consistent design
- **JavaScript**: Alpine.js 3 for reactive frontend interactions and component state management
- **HTTP Requests**: Axios for AJAX requests to Laravel API endpoints
- **Build Tool**: Vite with Laravel plugin for asset compilation
- **Styling**: Custom Figtree font family, extends Tailwind defaults
- **Responsive Design**: Mobile-first approach with Tailwind utilities
- **Accessibility**: Implement proper ARIA attributes when using components
- **CSRF Protection**: Include proper CSRF protection on all forms

### Alpine.js Patterns
- Use Blade components for server-side rendering with Alpine.js for client-side interactivity
- Implement Alpine.js directives (`x-data`, `x-show`, `x-if`, `x-for`) for reactive UI behavior
- Use Alpine.js `$store` for global state management across components
- Create reusable Alpine.js components using `Alpine.data()` for complex UI patterns
- Use Alpine.js `$watch` for reactive data observation and side effects

## Testing Strategy

- **Framework**: Pest PHP with custom expectations and helpers in `tests/Pest.php`
- **Feature Tests**: Use `RefreshDatabase` trait, test HTTP endpoints and user flows
- **Unit Tests**: Test individual classes and methods in isolation, especially Actions and Services
- **Coverage Requirements**: 90% minimum coverage for unit tests, 100% type coverage
- **Database**: In-memory SQLite for fast test execution
- **Test Data**: Use factories for test data generation
- **Mocking**: Mock external services and APIs in tests
- **Structure**: Group related functionality tests in dedicated directories

## Configuration Notes

### Quality Tools Configuration
- **PHPStan**: Level 5 analysis on `app/` directory
- **Pint**: Strict Laravel preset with additional formatting rules
- **Rector**: Configured for Laravel 12.0, PHP 8.3, code quality improvements
- **Pest**: Parallel execution enabled, coverage reporting configured

### Environment Setup
- **Database**: SQLite default (created automatically), easy MySQL/PostgreSQL switching
- **Queue**: Sync driver for development, file-based cache
- **Mail**: Array driver for development testing
- **Session**: File-based storage

## Common Development Patterns

### Adding New Features
1. Create routes in `routes/web.php` or separate route files
2. Generate controllers: `php artisan make:controller FeatureController`
3. Create models: `php artisan make:model Feature -m` (with migration)
4. Add Blade views in `resources/views/`
5. Write Feature tests first, then Unit tests
6. Run `composer run test:test` before committing

### Database Changes
1. Create migrations: `php artisan make:migration create_feature_table`
2. Update models with relationships and fillable fields
3. Create/update factories: `php artisan make:factory FeatureFactory`
4. Update seeders if needed
5. Test with `php artisan migrate:fresh --seed`

### Code Quality Workflow
1. **ALWAYS** analyze existing codebase patterns before making changes
2. Write code following established conventions and patterns
3. Run `composer run lint` to auto-fix formatting
4. Run `composer run test:types` for static analysis
5. Ensure tests pass with `composer run test:unit`
6. Verify full quality suite with `composer run test:test`
7. Use conventional commits for clear, semantic commit messages

## Error Handling & Security

### Exception Management
- Use custom exception classes in `app/Exceptions/`
- Implement proper error handling and logging
- Create custom exceptions when necessary
- Use try-catch blocks for expected exceptions
- Implement proper HTTP status codes
- Provide meaningful error messages
- Log important errors for debugging

### Security Practices
- Validate all user inputs using Form Requests
- Use CSRF protection on forms
- Implement proper authorization checks
- Sanitize file uploads
- Use prepared statements (Eloquent handles this automatically)
- Implement middleware for request filtering and modification

## Database Management

### Migration & Schema Design
- Use descriptive migration file names with timestamps
- Always add foreign key constraints where appropriate
- Use UUIDs/ULIDs for primary keys where required
- Include proper indexes for performance
- Use seeders for default/reference data
- Implement proper database transactions for data integrity

### Eloquent Best Practices
- Utilize Laravel's Eloquent ORM for database interactions
- Use Laravel's query builder for complex database queries
- Implement proper database relationships using Eloquent
- Use Repository pattern for data access layer when needed
- Implement proper database indexing for improved query performance

## Performance & Optimization

- Utilize Laravel's caching mechanisms for improved performance
- Implement job queues for long-running tasks
- Use Laravel's built-in pagination features
- Optimize database queries and avoid N+1 problems
- Use eager loading for relationships
- Implement proper API resource transformations

## Conventional Commits

Follow conventional commit standards for clear, semantic and succinct commit messages (prefer one-liners):

### Standard Commit Types
- **feat**: Adding new features
- **fix**: Bug fixes
- **docs**: Documentation changes
- **style**: Code style changes
- **refactor**: Code refactoring
- **test**: Adding or modifying tests
- **chore**: Maintenance tasks
- **perf**: Performance improvements

### Additional Conventions
- **Breaking Changes**: Add `!` after type/scope to indicate breaking changes
- **Scopes**: Use scopes for better organization (e.g., `feat(auth): add password reset`)
- **Examples**:
- `feat: add user profile editing`
- `fix(auth): resolve login validation issue`
- `refactor!: restructure user model relationships`

## Development Workflow

### Planning and Implementation
1. **Analysis**: First analyze existing codebase patterns and similar implementations
2. **Planning**: Think step-by-step, describe plan in pseudocode with great detail
3. **Implementation**: Write correct, up-to-date, bug-free, fully functional code
4. **Quality**: Focus on readability over performance, ensure code is complete
5. **Testing**: Write comprehensive tests, verify functionality
6. **Documentation**: Include proper docblocks and type annotations

### File Organization
- Group related functionality in dedicated directories
- Use namespaces that reflect directory structure
- Keep controllers thin, move business logic to Actions/Services
- Separate concerns: Controllers handle HTTP, Actions handle business logic
- Use Form Requests for validation logic

## 🔍 CODE ANALYSIS REQUIREMENTS
Before generating any code:
1. **MUST** search the codebase for similar patterns
2. **MUST** check existing Actions, Controllers, and Models for conventions
3. **MUST** use the same directory structure and naming patterns
4. **MUST** follow the same import and namespace conventions
5. **MUST** use the same validation and error handling patterns
