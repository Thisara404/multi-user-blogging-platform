<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'force.https' => \App\Http\Middleware\ForceHttps::class,
        ]);

        // Trust proxies for Railway
        $middleware->trustProxies(at: '*');

        // Apply ForceHttps middleware to web routes in production
        if (env('APP_ENV') === 'production') {
            $middleware->web([\App\Http\Middleware\ForceHttps::class]);
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
