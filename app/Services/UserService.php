<?php

namespace App\Services;

use App\Constants\ResponseStatusCode;
use App\Constants\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\ApiResponser;
use App\Validation\UserValidation;

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
    return $this->userRepository->getUserById($id);
  }

  /**
   * Create a new User
   * @param array $User
   * @return object $User
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

    return $this->userRepository->createUser($user);
  }
}
