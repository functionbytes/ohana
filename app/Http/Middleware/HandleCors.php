<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\HandleCors as Middleware;

class HandleCors extends Middleware
{

    protected $paths = ['api/*']; // Puedes especificar las rutas específicas que usarán CORS.

    protected $options = [
        'allowed_origins' => ['*'], // Especifica los orígenes permitidos. Usa '*' para todos los orígenes.
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'], // Métodos HTTP permitidos.
        'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization'], // Encabezados permitidos.
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => false,
    ];
}
