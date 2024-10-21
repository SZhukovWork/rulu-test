<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\GetAllUsersResponse;
use App\Http\Responses\UserResponse;
use App\Interfaces\User\DTO\CreateUserDTO;
use App\Interfaces\User\errors\UserNotFoundException;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAll(Request $request)
    {
        try {
            $validation = $request->validate([
                'id' => 'integer',
                'full_name' => 'string',
                'role' => 'string',
                'efficiency' => 'integer'
            ]);
        }
        catch (ValidationException $ex) {
            return new ErrorResponse($ex->getMessage(), 400);
        }
        return new GetAllUsersResponse(UserResource::collection(User::where($validation)->get()));
    }
    public function getById(int $id): ErrorResponse|UserResponse
    {
        try {
            $user = $this->userRepository->getById($id);
            return new UserResponse(new UserResource($user));
        }
        catch (UserNotFoundException $ex) {
            return new ErrorResponse($ex->getMessage(), 404);
        }
    }
    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $validation = $request->validate([
                'full_name' => 'required|string|max:50',
                'role' => 'required|string|max:50',
                'efficiency' => 'required|integer'
            ]);
        }
        catch (ValidationException $ex) {
            return new ErrorResponse($ex->getMessage(), 400);
        }
        $createUserDTO = new CreateUserDTO();
        $createUserDTO->role = $validation["role"];
        $createUserDTO->full_name = $validation["full_name"];
        $createUserDTO->efficiency = $validation["efficiency"];
        DB::beginTransaction();
        try{
            $user = $this->userRepository->update($createUserDTO,$id);
            DB::commit();
            return new UserResponse(new UserResource($user));
        } catch (UserNotFoundException $ex) {
            return new ErrorResponse($ex->getMessage(), 404);
        } catch(\Exception $ex){
            DB::rollback();
            return new ErrorResponse($ex->getMessage(), 500);
        }
    }
    public function create(Request $request): UserResponse|ErrorResponse
    {
        try {
            $validation = $request->validate([
                'full_name' => 'required|string|max:50',
                'role' => 'required|string|max:50',
                'efficiency' => 'required|integer'
            ]);
        }
        catch (ValidationException $ex) {
            return new ErrorResponse($ex->getMessage(), 400);
        }
        $createUserDTO = new CreateUserDTO();
        $createUserDTO->role = $validation["role"];
        $createUserDTO->full_name = $validation["full_name"];
        $createUserDTO->efficiency = $validation["efficiency"];
        DB::beginTransaction();
        try{
            $user = $this->userRepository->create($createUserDTO);
            DB::commit();
            return new UserResponse(new UserResource($user));
        }catch(\Exception $ex){
            DB::rollback();
            return new ErrorResponse($ex->getMessage(), 500);
        }
    }
    public function delete(int $id): UserResponse|ErrorResponse
    {
        $user = $this->userRepository->getById($id);
        if(!$user){
            return new ErrorResponse("User not found", 404);
        }
        DB::beginTransaction();
        try{
            $this->userRepository->delete($id);
            DB::commit();
            return new UserResponse(new UserResource($user));
        }catch(\Exception $ex){
            DB::rollback();
            return new ErrorResponse($ex->getMessage(), 500);
        }
    }

    public function deleteAll(): JsonResponse
    {
        $this->userRepository->delete(null);
        return response()->json(["success"=>true]);
    }
}
