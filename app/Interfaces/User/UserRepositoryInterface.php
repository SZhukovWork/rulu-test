<?php

namespace App\Interfaces\User;

use App\Interfaces\User\DTO\CreateUserDTO;
use App\Interfaces\User\errors\UserNotFoundException;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getAll();
    /**
     * @throws UserNotFoundException
     */
    public function getById(int $id): ?User;
    public function create(CreateUserDTO $data);
    /**
     * @throws UserNotFoundException
     */
    public function update(CreateUserDTO $data,int $id): ?User;
    /**
     * @throws UserNotFoundException
     */
    public function delete(array|int $ids): int;
}
