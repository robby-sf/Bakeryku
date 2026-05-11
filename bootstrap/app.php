<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authenticate;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => Authenticate::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'user' => \App\Http\Middleware\UserMiddleware::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'logout',
            'admin/auth/logout',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TokenMismatchException $e, $request) {
            if ($request->is('admin/auth/logout')) {
                Auth::guard('admin')->logout();

                return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
            }

            if ($request->is('logout')) {
                Auth::guard('user')->logout();

                return redirect('/')->with('success', 'Logout berhasil.');
            }

            return null;
        });
    })->create();
