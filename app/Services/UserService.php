<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
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
   * Create a ner User
   * @param array $User
   * @return object $User
   */
  public function makeUser(array $user)
  {
    return $this->userRepository->createUser($user);
  }
}
