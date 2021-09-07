<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
  public function getAllUsers();
  public function getUserById(int $id);
  public function createUser(array $User);
  public function updateUser(object $userModel, array $User);
  public function destroyUser(object $userModel, int $id);
  public function restoreUser(object $userModel, int $id);
}
