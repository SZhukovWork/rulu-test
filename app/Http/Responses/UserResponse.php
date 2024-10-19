<?php

namespace App\Http\Responses;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserResponse extends BaseApiJsonResponse
{
    public function __construct(UserResource $data)
    {
        parent::__construct($data);
    }
}
