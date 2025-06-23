<?php

use App\Http\Middleware\UserAccess;
use Illuminate\Foundation\Application;
use App\Http\Middleware\ForceHttpsAssetsMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ForceHttpsAssetsMiddleware::class);
         $middleware->alias([
             'UserAccess' => UserAccess::class,
         ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
