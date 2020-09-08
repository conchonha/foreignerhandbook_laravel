<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    	'http://192.168.1.3/foreignerhandbook_flutter/public/*',
       'http://localhost/foreignerhandbook_flutter/public/*',

    ];
}


