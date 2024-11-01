<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data = [], $message = '', $statusCode = 200, $status = true)
    {
        return response()->json([
            'status' => $status,
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
