<?php

use App\Http\Middleware\CheckAgentWebsite;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        // web: __DIR__.'/../routes/web.php',
        using: function () {
            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('staff')
                ->group(base_path('routes/staff.php'));

            Route::middleware('web')
                ->prefix('agent')
                ->group(base_path('routes/agent.php'));

            Route::middleware('web')
                ->prefix('customer')
                ->group(base_path('routes/customer.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkAgentWebsite' => CheckAgentWebsite::class,
        ])
            ->validateCsrfTokens(except: ['agent/quotes/payment-confirmation/response']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
