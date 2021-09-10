<?php

namespace App\Validation;

use App\Constants\Subscription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

final class SubscriptionValidation
{

  static function validateSubscription()
  {
    return Validator::make(request()->all(), [
      Subscription::STATUS => ['required', Rule::in(Subscription::STATUS_MAP)],
      Subscription::COURSES => 'required|array|min:1',
      Subscription::PERIOD => ['required', Rule::in(Subscription::PERIODS)],
    ]);
  }

  static function validateStatus()
  {
    return Validator::make(request()->all(), [
      Subscription::STATUS => ['required', Rule::in(Subscription::STATUS_MAP)],
    ]);
  }
}
