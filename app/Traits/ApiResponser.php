<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{

    /**
    * Build success response
    * @param string|array $data
    * @param int $code
    * @return Illuminate\Http\JsonResponse
    */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        // Determine site based on controller name
        $site = (strpos(get_class($this), 'User2Controller') !== false) ? 2 : 1;

        // If data is already wrapped with both data and site, return as is
        if (is_array($data) && isset($data['data']) && isset($data['site'])) {
            // Ensure the site value matches the controller
            $data['site'] = $site;
            return response()->json($data, $code);
        }

        // If we only have data, wrap it with site
        if (is_array($data) && isset($data['data'])) {
            return response()->json([
                'data' => $data['data'],
                'site' => $site
            ], $code);
        }

        // If not wrapped at all, wrap it completely
        return response()->json([
            'data' => $data,
            'site' => $site
        ], $code);
    }
    /**
    * Build error responses
    * @param string|array $message
    * @param int $code
    * @return Illuminate\Http\JsonResponse
    */

    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
    * Build error responses
    * @param string|array $message
    * @param int $code
    * @return Illuminate\Http\JsonResponse
    */

    public function errorResponse($message, $code)

    {
        return response()->json(['error' => $message, 'code' => $code],  $code);
    }

    /**
    * Build error responses
    * @param string|array $message
    * @param int $code
    * @return Illuminate\Http\JsonResponse
    */

    public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type','application/json');
    }
}
