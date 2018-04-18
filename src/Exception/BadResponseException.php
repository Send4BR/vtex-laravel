<?php

namespace Send4\Vtex\Exception;

use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Exception when an HTTP error occurs (4xx or 5xx error)
 */
class BadResponseException
{
    /**
     * JsonExceptions constructor.
     */
    public function __construct($code, $message = null)
    {
        $success = false;

        if ($code >=200 && $code <= 299){
            $success = true;
        }

        throw new HttpResponseException(
            response()->json([
                'success' => $success,
                'message' => $message
            ], $code)
        );
    }
}
