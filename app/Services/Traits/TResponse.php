<?php

namespace App\Services\Traits;

use Illuminate\Http\Response;

trait TResponse
{
    /**
     * 
     */
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

    /**
     *  @param  array|object  $data | Dữ liệu
     *  @param  string  $message | Nội dung thông báo 
     *  @param  bool  $status | Trạng thái 
     *  @param  int  $code | HTTP code response 
     */
    function sendResponse(array|object $data = null, string $message = null, bool $status = true, int $code = Response::HTTP_OK)
    {
        $response = [
            'status' => $status,
            'code' => $code,
            'payload' => $data,
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }

    /**
     *  @param  string  $message | Nội dung thông báo 
     *  @param  int  $code | HTTP code response 
     * @param  array|object  $dataError | Dữ liệu
     */
    function sendResponseError(string $message, int $code = Response::HTTP_NOT_FOUND, array|object $dataError = [])
    {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $message,
        ];
        if (!empty($dataError)) {
            $response['payload'] = $dataError;
        }
        return response()->json($response, $code);
    }


    function sendResponseNull()
    {
        $response = [
            'status' => false,
            'code' => Response::HTTP_OK,
            'message' => trans('message.data_null'),
            'payload' => null,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}