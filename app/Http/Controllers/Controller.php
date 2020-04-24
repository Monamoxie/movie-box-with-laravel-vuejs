<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function errorResponse($errors, $message=null, $code=500) {
        if($message == null && is_string($errors))
            $message = $errors;
        return Response::json([
            'errors' => $errors,
            'data' => null,
            'message' => $message,
            'status' => 'error'
            ], $code);
    }

    protected function successResponse($message, $data=null, $code=200) {
        return Response::json([
            'errors' => null,
            'data' => $data,
            'message' => $message,
            'status' => 'success'
        ], $code);
    }
}
