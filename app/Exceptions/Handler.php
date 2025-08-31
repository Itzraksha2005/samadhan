<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Authentication failure ko handle karo
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized - Token missing or invalid',
        ], 401);
    }
}
