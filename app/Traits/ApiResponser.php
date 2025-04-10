<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{

    
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response ($data, $code)->header('Content-Type', 'application/json');
    }
    
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    public function errorResponse($message, $code)
{
    $response = is_array($message) ? $message : ['error' => $message];
    $response['code'] = $code;

    return response()->json($response, $code);
}


    public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}