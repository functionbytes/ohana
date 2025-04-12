<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'webhooks/*',
        'plugins/webhooks/*',
        'delivery/*',
        'api/*',
        '*/embedded-form-*',
        'payments/stripe/credit-card*',
        'frontend/*',
        'manager/*',
    ];
}
