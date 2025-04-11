<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();
$app->withEloquent();

$app->configure('services');
$app->configure('auth');
$app->configure('app');

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// Register route middleware. (Removed the Passport client.credentials middleware.)
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class
]);

// Register Service Providers
$app->register(App\Providers\AuthServiceProvider::class);
// Removed: $app->register(Laravel\Passport\PassportServiceProvider::class);
// Removed: $app->register(Dusterio\LumenPassport\PassportServiceProvider::class);

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
