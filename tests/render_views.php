<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;

$basePath = realpath(__DIR__ . '/..');

// Force a DB-free, file-based runtime. These must also be set in $_ENV/$_SERVER
// so the immutable .env loader cannot override them.
foreach ([
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => ':memory:',
    'SESSION_DRIVER' => 'file',
    'CACHE_STORE' => 'file',
    'QUEUE_CONNECTION' => 'sync',
] as $key => $value) {
    putenv("{$key}={$value}");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

$app = Illuminate\Foundation\Application::configure(basePath: $basePath)
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {})
    ->withExceptions(function ($exceptions) {})
    ->create();

$app->loadEnvironmentFrom('.env');

// Boot the full application using the same bootstrap sequence as the HTTP
// kernel so configuration and every service provider (filesystem, translator,
// session, auth, Gate, view, pagination) is registered, matching a normal
// `php artisan serve` boot. HandleExceptions is intentionally omitted so PHP
// warnings stay visible instead of being converted to ErrorExceptions.
$app->bootstrapWith([
    LoadEnvironmentVariables::class,
    LoadConfiguration::class,
    RegisterFacades::class,
    RegisterProviders::class,
    BootProviders::class,
]);

// The file-based session/cache drivers need their directories to exist.
foreach (['storage/framework/views', 'storage/framework/sessions', 'storage/framework/cache/data'] as $dir) {
    if (! is_dir($path = $basePath . '/' . $dir)) {
        mkdir($path, 0777, true);
    }
}

// A concrete request so request()->routeIs() and route generation behave normally.
$app->instance('request', Request::create('/', 'GET'));

// Keep spatie/laravel-permission away from the database during rendering:
// disable its Gate hook (before the Gate is first resolved) and allow every
// @can check so all permission-gated buttons render in the test output.
$app->make('config')->set('permission.register_permission_check_method', false);
$app->make(Gate::class)->before(fn () => true);

// Fake authenticated user so Auth::user() and the navigation render correctly.
$authUser = (new App\Models\User())->forceFill([
    'id' => 1,
    'name' => 'Test User',
    'email' => 'test@example.com',
]);
$app->make('auth')->guard()->setUser($authUser);

$cachePath = $basePath . '/storage/framework/views';

$files = new Filesystem($basePath);

$resolver = new EngineResolver();
$resolver->register('php', function () use ($files, $cachePath) {
    return new PhpEngine(new Illuminate\View\Compilers\Compiler($files, $cachePath));
});

$bladeCompiler = new BladeCompiler($files, $cachePath);

$resolver->register('blade', function () use ($bladeCompiler) {
    return new CompilerEngine($bladeCompiler);
});

$finder = new FileViewFinder($files, [$basePath . '/resources/views']);

// The manual factory below replaces the container's view factory, so it needs
// the pagination namespace (used by ->links() on paginators) that
// PaginationServiceProvider registered on the original factory.
$finder->addNamespace('pagination', [
    $basePath . '/resources/views/vendor/pagination',
    $basePath . '/vendor/laravel/framework/src/Illuminate/Pagination/resources/views',
]);

// Bind a minimal dispatcher so the Factory can be constructed.
$events = new Illuminate\Events\Dispatcher($app);
$app->instance('events', $events);

$factory = new Factory($resolver, $finder, $app['events']);

// Point paginators' ->links() at this factory as well.
AbstractPaginator::viewFactoryResolver(fn () => $factory);

$views = [
    'users.create-users',
    'users.edit-users',
    'roles.create-role',
    'roles.edit-role',
    'users.index',
    'roles.index',
    'users.view-users',
    'roles.view-role',
    'dashboard',
    'auth.login',
    'auth.register',
    'auth.forgot-password',
    'auth.confirm-password',
    'auth.verify-email',
    'auth.reset-password',
    'profile.edit',
    'layouts.app',
    'layouts.guest',
    'layouts.navigation',
];

$app->instance('view', $factory);

$errors = new ViewErrorBag(['default' => new MessageBag]);

// Eloquent stand-ins using raw attributes: routable by route() and free of any
// database access (rendering never queries).
$makeModel = function (array $attributes) {
    $model = new class extends \Illuminate\Database\Eloquent\Model {
        protected $guarded = [];
    };

    $model->setRawAttributes($attributes);

    return $model;
};

$permEdit = $makeModel(['id' => 1, 'name' => 'edit users']);
$permDelete = $makeModel(['id' => 2, 'name' => 'delete users']);

$adminRole = $makeModel(['id' => 1, 'name' => 'Admin', 'guard_name' => 'web', 'users_count' => 2]);
$adminRole->permissions = new Collection([$permEdit, $permDelete]);

$editorRole = $makeModel(['id' => 2, 'name' => 'Editor', 'guard_name' => 'web', 'users_count' => 0]);
$editorRole->permissions = new Collection([$permEdit]);

$testUser = $makeModel([
    'id' => 1,
    'name' => 'Test User',
    'email' => 'test@example.com',
    'created_at' => new DateTime('-5 days'),
]);
$testUser->roles = new Collection([$adminRole]);
$testUser->permissions = new Collection([$permEdit]);

$otherUser = $makeModel([
    'id' => 2,
    'name' => 'Other User',
    'email' => 'other@example.com',
    'created_at' => new DateTime('-1 day'),
]);
$otherUser->roles = new Collection([$editorRole]);
$otherUser->permissions = new Collection();

$paginate = fn (array $items) => new LengthAwarePaginator($items, count($items), 15, 1, ['path' => '/']);

$data = [
    'users.create-users' => ['roles' => [$adminRole, $editorRole]],
    'users.edit-users'   => ['user' => $testUser, 'roles' => [$adminRole, $editorRole]],
    'roles.create-role'  => ['permissions' => [$permEdit, $permDelete]],
    'roles.edit-role'    => ['role' => $adminRole, 'permissions' => [$permEdit, $permDelete]],
    'users.index'        => ['users' => $paginate([$testUser, $otherUser])],
    'roles.index'        => ['roles' => $paginate([$adminRole, $editorRole])],
    'users.view-users'   => ['user' => $testUser],
    'roles.view-role'    => ['role' => $adminRole, 'users' => $paginate([$testUser, $otherUser])],
    'dashboard'          => [],
    'auth.login'         => ['status' => null],
    'auth.register'      => [],
    'auth.forgot-password' => [],
    'auth.confirm-password' => [],
    'auth.verify-email'  => [],
    'auth.reset-password' => ['request' => $app->make('request')],
    'profile.edit'       => ['user' => $testUser],
    'layouts.app'        => ['header' => 'Test Header', 'slot' => '<p>Test slot</p>'],
    'layouts.guest'      => ['slot' => '<p>Test slot</p>'],
    'layouts.navigation' => [],
];

// In a real request the web middleware shares $errors with every view; do the
// same here since views are rendered directly.
foreach ($data as $viewName => $params) {
    $data[$viewName] = $params + ['errors' => $errors];
}

$failures = 0;
foreach ($views as $view) {
    try {
        $factory->make($view, $data[$view])->render();
        echo "[OK] {$view}\n";
    } catch (Throwable $e) {
        $failures++;
        echo "[FAIL] {$view}: " . $e->getMessage() . "\n";
        echo "  " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
}

echo "\n" . ($failures === 0 ? "All views rendered OK.\n" : "{$failures} view(s) failed.\n");
exit($failures === 0 ? 0 : 1);
