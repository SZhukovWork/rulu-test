<?php

namespace App\Repositories\User;

use App\Interfaces\User\DTO\CreateUserDTO;
use App\Interfaces\User\errors\UserNotFoundException;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(){
        return User::all();
    }

    public function getById($id): ?User{
        $user = User::find($id);
        if(!$user){
            throw new UserNotFoundException($id);
        }
        return $user;
    }

    public function create(CreateUserDTO $data){
        return User::create((array)$data);
    }

    /**
     * @throws UserNotFoundException
     */
    public function update(CreateUserDTO $data, $id): User{
        $user = User::find($id);
        if(!$user){
            throw new UserNotFoundException($id);
        }
        $user->update((array)$data);
        return $user;
    }

    public function delete(array|int|null $ids): int{
        if($ids === null){
            return User::query()->delete();
        }
        return User::destroy($ids);
    }
}
