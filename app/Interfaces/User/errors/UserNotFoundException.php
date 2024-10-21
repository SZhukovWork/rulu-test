<?php

namespace App\Interfaces\User\errors;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct(int $userId)
    {
        parent::__construct("User by id {$userId} not found");
    }
}
