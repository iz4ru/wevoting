<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\ValidateVoterSession;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectIfVoterAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware){
        $middleware->alias([
            'voter.guest' => RedirectIfVoterAuthenticated::class,
            'voter.validate' => ValidateVoterSession::class,   
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
