<laravel-boost-guidelines>
=== boost rules ===

## Laravel Boost
- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan
- Use the `list-artisan-commands` tool when you need to call an Artisan command to double check the available parameters.

## URLs
- Whenever you share a project URL with the user you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain / IP, and port.

## Tinker / Debugging
- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.

## Reading Browser Logs With the `browser-logs` Tool
- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)
- Boost comes with a powerful `search-docs` tool you should use before any other approaches. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation specific for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- The 'search-docs' tool is perfect for all Laravel related packages, including Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, Nightwatch, etc.
- You must use this tool to search for Laravel-ecosystem documentation before falling back to other approaches.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic based queries to start. For example: `['rate limiting', 'routing rate limiting', 'routing']`.

### Available Search Syntax
- You can and should pass multiple queries at once. The most relevant results will be returned first.

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit"
3. Quoted Phrases (Exact Position) - query="infinite scroll" - Words must be adjacent and in that order
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit"
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms


=== herd rules ===

## Laravel Herd

- The application is served by Laravel Herd and will be available at: https?://[kebab-case-project-dir].test. Use the `get-absolute-url` tool to generate URLs for the user to ensure valid URLs.
- You must not run any commands to make the site available via HTTP(s). It is _always_ available through Laravel Herd.


=== laravel/core rules ===

## Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Database
- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation
- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources
- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

### Controllers & Validation
- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

### Queues
- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

### Authentication & Authorization
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

### URL Generation
- When generating links to other pages, prefer named routes and the `route()` function.

### Configuration
- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

### Testing
- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] <name>` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

### Vite Error
- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.


=== laravel/v12 rules ===

## Laravel 12

- Use the `search-docs` tool to get version specific documentation.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

### Laravel 12 Structure
- No middleware files in `app/Http/Middleware/`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- **No app\Console\Kernel.php** - use `bootstrap/app.php` or `routes/console.php` for console configuration.
- **Commands auto-register** - files in `app/Console/Commands/` are automatically available and do not require manual registration.

### Database
- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 11 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models
- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.


=== pint/core rules ===

## Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues.


=== pest/core rules ===

## Pest

### Testing
- If you need to verify a feature is working, write or update a Unit / Feature test.

### Pest Tests
- All tests must be written using Pest. Use `php artisan make:test --pest <name>`.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files - these are core to the application.
- Tests should test all of the happy paths, failure paths, and weird paths.
- Tests live in the `tests/Feature` and `tests/Unit` directories.
- Pest tests look and behave like this:
<code-snippet name="Basic Pest Test Example" lang="php">
it('is true', function () {
    expect(true)->toBeTrue();
});
</code-snippet>

### Running Tests
- Run the minimal number of tests using an appropriate filter before finalizing code edits.
- To run all tests: `php artisan test`.
- To run all tests in a file: `php artisan test tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `php artisan test --filter=testName` (recommended after making a change to a related file).
- When the tests relating to your changes are passing, ask the user if they would like to run the entire test suite to ensure everything is still passing.

### Pest Assertions
- When asserting status codes on a response, use the specific method like `assertForbidden` and `assertNotFound` instead of using `assertStatus(403)` or similar, e.g.:
<code-snippet name="Pest Example Asserting postJson Response" lang="php">
it('returns all', function () {
    $response = $this->postJson('/api/docs', []);

    $response->assertSuccessful();
});
</code-snippet>

### Mocking
- Mocking can be very helpful when appropriate.
- When mocking, you can use the `Pest\Laravel\mock` Pest function, but always import it via `use function Pest\Laravel\mock;` before using it. Alternatively, you can use `$this->mock()` if existing tests do.
- You can also create partial mocks using the same import or self method.

### Datasets
- Use datasets in Pest to simplify tests which have a lot of duplicated data. This is often the case when testing validation rules, so consider going with this solution when writing tests for validation rules.

<code-snippet name="Pest Dataset Example" lang="php">
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
</code-snippet>


=== tailwindcss/core rules ===

## Tailwind Core

- Use Tailwind CSS classes to style HTML, check and use existing tailwind conventions within the project before writing your own.
- Offer to extract repeated patterns into components that match the project's conventions (i.e. Blade, JSX, Vue, etc..)
- Think through class placement, order, priority, and defaults - remove redundant classes, add classes to parent or child carefully to limit repetition, group elements logically
- You can use the `search-docs` tool to get exact examples from the official documentation when needed.

### Spacing
- When listing items, use gap utilities for spacing, don't use margins.

    <code-snippet name="Valid Flex Gap Spacing Example" lang="html">
        <div class="flex gap-8">
            <div>Superior</div>
            <div>Michigan</div>
            <div>Erie</div>
        </div>
    </code-snippet>


### Dark Mode
- If existing pages and components support dark mode, new pages and components must support dark mode in a similar way, typically using `dark:`.


=== tailwindcss/v3 rules ===

## Tailwind 3

- Always use Tailwind CSS v3 - verify you're using only classes supported by this version.


=== tests rules ===

## Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test` with a specific filename or filter.


=== .ai/project-guideline rules ===

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
</laravel-boost-guidelines>