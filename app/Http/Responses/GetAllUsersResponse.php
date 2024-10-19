<?php

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllUsersResponse extends BaseApiJsonResponse
{
    public function __construct(AnonymousResourceCollection $data)
    {
        parent::__construct($data);
    }
}
