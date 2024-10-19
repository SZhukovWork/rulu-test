<?php

namespace App\Interfaces\User;

use App\Interfaces\User\DTO\CreateUserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById(int $id): ?User;
    public function create(CreateUserDTO $data);
    public function update(CreateUserDTO $data,int $id): ?User;
    public function delete(array|int $ids): int;
}
