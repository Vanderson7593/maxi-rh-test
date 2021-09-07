<?php

namespace App\Repositories;

use App\Constants\Model;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
  protected $entity;

  public function __construct(User $user)
  {
    $this->entity = $user;
  }

  /**
   * Get all Users
   * @return array
   */
  public function getAllUsers()
  {
    return $this->entity->all();
  }

  /**
   * Get user by ID
   * @param int $id
   * @return object
   */
  public function getUserById(int $id)
  {
    return $this->entity->where('id', $id)->first();
  }

  /**
   * Create new User
   * @param array $user
   * @return object
   */
  public function createUser(array $User)
  {
    return $this->entity->create($User);
  }

  /**
   * Update User
   * @param object $user
   * @param array $User
   * @return object
   */
  public function updateUser(object $userModel, array $User)
  {
    return $userModel->update($User);
  }


  /**
   * Restore User
   * @param object $userModel
   * @param int $id
   */
  public function restoreUser(object $userModel, int $id)
  {
    return $userModel->update([Model::IS_DELETED => false]);
  }

  /**
   * Delete User
   * @param object $userModel
   */
  public function destroyUser(object $userModel, int $id)
  {
    return $userModel->update([Model::IS_DELETED => true]);
  }
}
