<?php

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ErrorResponse extends BaseApiJsonResponse
{
    public function __construct(string $message,$code = 400)
    {
        parent::__construct([
            "error" => $message
        ],false, $code);
    }
}
