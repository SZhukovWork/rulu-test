<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class BaseApiJsonResponse extends JsonResponse
{
    public function __construct($data = null,bool $success = true, $status = 200, $headers = [], $options = 0, $json = false)
    {
        parent::__construct([
            "success"=> $success,
            "result"=>$data,
        ], $status, $headers, $options, $json);
    }


}
