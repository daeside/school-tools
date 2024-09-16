<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use \Exception as Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function handleException(?Request $request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'error' => 'Invalid request',
                'details' => $exception->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found',
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'error' => 'Internal server error',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
