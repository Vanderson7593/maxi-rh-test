<?php

namespace App\Services;

use App\Constants\ResponseMessages;
use App\Constants\ResponseStatusCode;
use App\Constants\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\ApiResponser;
use App\Validation\UserValidation;
use Illuminate\Support\Facades\Hash;

class UserService
{

  use ApiResponser;

  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  /**
   * Get all Users
   * @return array
   */
  public function getAllUsers()
  {
    return $this->userRepository->getAllUsers();
  }

  /**
   * Get User by Id
   * @param int $id
   * @return object 
   */
  public function getUserById(int $id)
  {
    $user = $this->userService->getUserById($id);

    if (!$user) {
      return $this->errorResponse(ResponseMessages::USER_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    return $this->successResponse($user, null, ResponseStatusCode::SUCCESS);
  }

  /**
   * Create a new User
   * @param array $User
   * @return object $User
   * 
   */
  public function makeUser(array $user)
  {
    $validator = null;

    if ($user[User::ROLE] === User::ROLES[2]) {
      $validator = UserValidation::validateStudent();
    } else {
      $validator = UserValidation::validateUser();
    }

    if ($validator->fails()) {
      return $this->errorResponse($validator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    $user[User::PASSWORD] = Hash::make($validator->validated()[User::PASSWORD]);

    $data = $this->userRepository->createUser($user);
    return $this->successResponse($data, ResponseMessages::USER_CREATED, ResponseStatusCode::SUCCESS);
  }

  public function updateUser($id, array $user)
  {
    $validator = null;

    $user = $this->userService->getUserById($id);

    if (!$user) {
      return $this->errorResponse(ResponseMessages::USER_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    if ($user[User::ROLE] === User::ROLES[2]) {
      $validator = UserValidation::validateStudent();
    } else {
      $validator = UserValidation::validateUser();
    }

    if ($validator->fails()) {
      return $this->errorResponse($validator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    $user[User::PASSWORD] = Hash::make($validator->validated()[User::PASSWORD]);

    $data = $this->userRepository->updateUser($id, $user);
    return $this->successResponse($data, ResponseMessages::USER_UPDATED, ResponseStatusCode::SUCCESS);
  }
}
