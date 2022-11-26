<?php

namespace App\Exceptions;

use App\Services\Traits\TResponse;
use Exception;

class NotFoundApiException extends Exception
{
    use TResponse;
    public function render($request)
    {
        return $this->sendResponse(null, trans('message.not_found'), false, 404);
    }
}