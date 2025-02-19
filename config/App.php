<?php

namespace Config;

class App
{
    public static array $middlewareAliases = [
        'auth' => \App\Middleware\Authenticate::class,
        'admin' => \App\Middleware\AdminMiddleware::class,
        'barber' => \App\Middleware\BarberMiddleware::class,
        'client' => \App\Middleware\ClientMiddleware::class,
    ];
}
