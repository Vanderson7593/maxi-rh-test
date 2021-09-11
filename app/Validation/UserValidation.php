<?php

namespace App\Validation;

use App\Constants\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

final class UserValidation
{

  static function validateUser()
  {
    return Validator::make(request()->all(), [
      User::NAME => 'required|string',
      User::EMAIL => 'required|string|email|unique:users',
      User::ROLE => ['required', Rule::in(User::ROLES)],
      User::PASSWORD => 'required|string|min:6|confirmed',
    ]);
  }

  static function validateStudent()
  {
    return Validator::make(request()->all(), [
      User::NAME => 'required|string',
      User::EMAIL => "required|string|email|unique:users",
      User::UF => 'required|string|max:2|',
      User::CPF => 'required|string|max:11',
      User::ADDRESS => 'required|string',
      User::COMPANY => 'required|string',
      User::TELEPHONE => 'required|string',
      User::PHONE => 'required|string',
      User::CATEGORY => ['required', Rule::in(User::CATEGORIES)],
      User::ROLE => ['required', Rule::in(User::ROLES)],
      User::PASSWORD => 'required|string|min:6|confirmed',
    ]);
  }

  static function validateStudentOnUpdate(int $user_id = null)
  {
    return Validator::make(request()->all(), [
      User::NAME => 'required|string',
      User::EMAIL => "required|string|email|unique:users,email,{$user_id},id",
      User::UF => 'required|string|max:1|',
      User::CPF => 'required|string|max:11',
      User::ADDRESS => 'required|string',
      User::COMPANY => 'required|string',
      User::TELEPHONE => 'required|string',
      User::PHONE => 'required|string',
      User::CATEGORY => ['required', Rule::in(User::CATEGORIES)],
      User::ROLE => ['required', Rule::in(User::ROLES)]
    ]);
  }
}
