<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Middleware global
    protected $middleware = [
        // daftar middleware global
    ];

    // Middleware grup
    protected $middlewareGroups = [
        'web' => [
            // daftar middleware web
        ],

        'api' => [
            // daftar middleware api
        ],
    ];

    // Middleware per route
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin.auth' => \App\Http\Middleware\AdminAuth::class,
        'organisasi.auth' => \App\Http\Middleware\OrganisasiAuth::class,
        'warek.auth' => \App\Http\Middleware\WarekAuth::class, // <- benar di sini
    ];
}
