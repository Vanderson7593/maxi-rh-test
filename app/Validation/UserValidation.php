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
      User::NAME => 'required|string|max:255|',
      User::EMAIL => 'required|string|email|max:255|unique:users',
      User::ROLE => ['required', Rule::in(User::ROLES)],
      User::PASSWORD => 'required|string|min:6|confirmed',
    ]);
  }

  static function validateStudant()
  {
    return Validator::make(request()->all(), [
      User::NAME => 'required|string|max:255|',
      User::EMAIL => 'required|string|email|max:255|unique:users',
      User::CPF => 'required|string|max:9',
      User::ADDRESS => 'required|string|max:25',
      User::COMPANY => 'required|string|max:70',
      User::TELEPHONE => 'required|string|max:20',
      User::PHONE => 'required|string|max:20',
      User::COURSE_ID => 'required|numeric',
      User::CATEGORY => ['required', Rule::in(User::CATEGORIES)],
      User::ROLE => ['required', Rule::in(User::ROLES)],
      User::PASSWORD => 'required|string|min:6|confirmed',
    ]);
  }
}