<?php

namespace App\Repositories\User;

use App\Interfaces\User\DTO\CreateUserDTO;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(){
        return User::all();
    }

    public function getById($id): ?User{
        return User::find($id);
    }

    public function create(CreateUserDTO $data){
        return User::create((array)$data);
    }

    public function update(CreateUserDTO $data,$id): ?User{
        $user = User::find($id);
        if(!$user){
            return null;
        }
        $user->update((array)$data);
        return $user;
    }

    public function delete(array|int $ids): int{
        return User::destroy($ids);
    }
}
