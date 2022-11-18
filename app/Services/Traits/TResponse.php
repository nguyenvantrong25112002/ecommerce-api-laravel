<?php

namespace App\Services\Traits;

use Illuminate\Http\Response;

trait TResponse
{
    function responseApi($status = false, $data = "Not found", $dataAppend = [], $code =  Response::HTTP_OK)
    {
        if (!$status) $code = Response::HTTP_NOT_FOUND;
        if (!$status) $data = ['status' => $status, 'message' => $data];
        if ($status) $data = ['status' => $status, 'payload' => $data];
        if ($status) $data = array_merge($data, $dataAppend);
        return response()->json(
            $data,
            $code
        );
    }
    function sendResponse($data, $message = '', $code = Response::HTTP_OK)
    {
        $response = [
            'status' => true,
            'code' => $code,
            'payload' => $data,
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    function sendResponseError($error, $errorMessages = [], $code = Response::HTTP_NOT_FOUND)
    {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['payload'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}