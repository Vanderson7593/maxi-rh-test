<?php

namespace App\Services;

use App\Constants\ResponseMessages;
use App\Constants\StatusCodes;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use App\Traits\ApiResponser;
use Error;

class SubscriptionService
{

  use ApiResponser;

  protected $subscriptionRepository;

  public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
  {
    $this->subscriptionRepository = $subscriptionRepository;
  }

  public function getAllSubscriptions()
  {
    return $this->subscriptionRepository->getAllSubscriptions();
  }

  public function getSubscriptionById(int $id)
  {
    return $this->subscriptionRepository->getSubscriptionById($id);
  }

  public function makeSubscription(array $Subscription)
  {
    return $this->subscriptionRepository->createSubscription($Subscription);
  }

  public function updateSubscription(int $id, array $subscription)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::NOT_FOUND, StatusCodes::NOT_FOUND);
    }



    return $this->subscriptionRepository->updateSubscription($sub, $subscription);
  }

  public function destroySubscription(int $id)
  {
    $sub = $this->subscriptionRepository->getSubscriptionById($id);

    if (!$sub) {
      return $this->errorResponse(ResponseMessages::NOT_FOUND, StatusCodes::NOT_FOUND);
    }

    $this->subscriptionRepository->destroySubscription($sub, $id);

    return $this->successResponse(null, ResponseMessages::DELETED);
  }
}
