<?php

namespace App\Services;

use App\Constants\ResponseMessages;
use App\Constants\ResponseStatusCode;
use App\Constants\Subscription;
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

  public function getAllSubscriptions($queries)
  {
    $data = $this->subscriptionRepository->getAllSubscriptions($queries);
    return $this->successResponse($data, null, ResponseStatusCode::SUCCESS);
  }

  public function getSubscriptionById(int $id)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    return $this->successResponse($sub, null, ResponseStatusCode::SUCCESS);
  }

  public function updateSubscriptionStatus(int $id, array $req)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    $subscriptionValidator = SubscriptionValidation::validateStatus();

    if ($subscriptionValidator->fails()) {
      return $this->errorResponse($subscriptionValidator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    $tempSub = $this->subscriptionRepository->updateSubscriptionStatus($sub, $subscriptionValidator->validated()['status']);

    return $this->successResponse($tempSub, ResponseMessages::SUBSCRIPION_STATUS_UPDATED, ResponseStatusCode::SUCCESS);
  }

  public function calculateTotal(array $coursesIds)
  {
    $total = $this->courseRepository->sumCoursesIds($coursesIds);
    return $total;
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

    $tempSub = [
      Subscription::USER_ID => $user->id,
      Subscription::TOTAL => $this->calculateTotal($coursesIds)
    ];

    $sub = $this->subscriptionRepository->createSubscription(array_merge($filteredFields, $tempSub));
    $sub->courses()->sync($coursesIds);

    return $this->successResponse($sub, ResponseMessages::SUBSCRIPION_CREATED, ResponseStatusCode::SUCCESS);
  }

  public function updateSubscription(int $id, array $subscription)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::SUBSCRIPTION_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    $user = $sub->user;

    $userValidator = UserValidation::validateStudentOnUpdate($user['id']);
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

    $tempSub = [
      Subscription::USER_ID => $user->id,
      Subscription::TOTAL => $this->calculateTotal($coursesIds)
    ];

    $this->subscriptionRepository->updateSubscription($sub, array_merge($filteredFields, $tempSub));
    $sub->courses()->sync($coursesIds);

    return $this->successResponse($sub, ResponseMessages::SUBSCRIPION_UPDATED, ResponseStatusCode::SUCCESS);
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
