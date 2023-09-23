<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
     /* '/register',//facing 419 Expired issue and I'm tired lol
      '/login',
      '/logout',
      '/confirm-password',
      '/verify-email',
      '/verify-email/request',
      'verify-email/{id}/{hash}'*/
      'send-ripple/{encrypted_url}',
    ];
}
