<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthorizationException $e) {
            return response()->json([
                "status" => "error",
                'errors' => [
                    'generic' =>'Not authenticated'
                ]
            ], JsonResponse::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (Throwable $e) {

            if (env('APP_ENV') === 'local') {
                Log::error($e);
            }
            return response()->json([
                "status" => "error",
                'errors' => ['generic' =>'Unknown error , please try again later']
            ], JsonResponse::HTTP_BAD_REQUEST);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
