<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\HTTPHelpers;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

  protected $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function index()
  {
    return $this->userService->getAllUsers();
  }

  public function show($user)
  {
    return $this->userService->getUserById($user);
  }

  public function store(Request $request)
  {
    return $this->userService->makeUser($request->json()->all());
  }
}
