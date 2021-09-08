<?php

namespace App\Services;

use App\Constants\ResponseMessages;
use App\Constants\ResponseStatusCode;
use App\Helpers\Helpers;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiResponser;
use App\Validation\SubscriptionValidation;
use App\Validation\UserValidation;
use Illuminate\Support\Arr;

class SubscriptionService
{

  use ApiResponser;

  protected $subscriptionRepository;
  protected $userRepository;
  protected $courseRepository;

  public function __construct(SubscriptionRepositoryInterface $subscriptionRepository, UserRepository $userRepository, CourseRepository $courseRepository)
  {
    $this->subscriptionRepository = $subscriptionRepository;
    $this->userRepository = $userRepository;
    $this->courseRepository = $courseRepository;
  }

  public function getAllSubscriptions()
  {
    return $this->subscriptionRepository->getAllSubscriptions();
  }

  public function getSubscriptionById(int $id)
  {
    return $this->subscriptionRepository->getSubscriptionById($id);
  }

  public function makeSubscription(array $subscription)
  {

    $userValidator = UserValidation::validateStudent();
    $subscriptionValidator = SubscriptionValidation::validateSubscription();


    if ($userValidator->fails()) {
      return $this->errorResponse($userValidator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    if ($subscriptionValidator->fails()) {
      return $this->errorResponse($subscriptionValidator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    $coursesIds = $subscription['courses'];

    $validCourses = $this->courseRepository->verifyCoursesIds($coursesIds);
    if (!$validCourses) {
      return $this->errorResponse(ResponseMessages::COURSE_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    $user = $this->userRepository->createUser($userValidator->validated());

    $filteredFields = Arr::except($subscriptionValidator->validated(), ['courses']);

    $subscriptionTotal = $this->courseRepository->sumCoursesIds($coursesIds);

    $subFieldsWithUser = Arr::add($filteredFields, 'user_id', $user->id);
    $subFieldsWithTotal = Arr::add($subFieldsWithUser, 'total', $subscriptionTotal);

    $sub = $this->subscriptionRepository->createSubscription($subFieldsWithTotal);
    $sub->courses()->sync($coursesIds);

    return $this->successResponse($sub, ResponseMessages::SUBSCRIPION_CREATED, ResponseStatusCode::SUCCESS);
  }

  public function updateSubscription(int $id, array $subscription)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);
    $user = $this->userRepository->getUserById($subscription['user_id']);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    if (!$user) {
      return $this->errorResponse(ResponseMessages::USER_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    $userValidator = UserValidation::validateStudent($user->id);
    $subscriptionValidator = SubscriptionValidation::validateSubscription();

    if ($userValidator->fails()) {
      return $this->errorResponse($userValidator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    if ($subscriptionValidator->fails()) {
      return $this->errorResponse($subscriptionValidator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    $coursesIds = $subscription['courses'];

    $validCourses = $this->courseRepository->verifyCoursesIds($coursesIds);
    if (!$validCourses) {
      return $this->errorResponse(ResponseMessages::COURSE_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    $this->userRepository->updateUser($user, $userValidator->validated());

    $filteredFields = Arr::except($subscriptionValidator->validated(), ['courses']);

    $subscriptionTotal = $this->courseRepository->sumCoursesIds($coursesIds);

    $subFieldsWithUser = Arr::add($filteredFields, 'user_id', $user->id);
    $subFieldsWithTotal = Arr::add($subFieldsWithUser, 'total', $subscriptionTotal);

    // dd($coursesIds);

    // dd($subFieldsWithTotal);

    $this->subscriptionRepository->updateSubscription($sub, $subFieldsWithTotal);
    $sub->courses()->sync($coursesIds);

    return $this->successResponse($sub, ResponseMessages::SUBSCRIPION_CREATED, ResponseStatusCode::SUCCESS);
  }

  public function destroySubscription(int $id)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    $this->subscriptionRepository->destroySubscription($sub, $id);

    return $this->successResponse(null, ResponseMessages::DELETED);
  }
}
