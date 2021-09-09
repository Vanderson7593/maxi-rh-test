<?php

namespace App\Repositories\Contracts;

interface SubscriptionRepositoryInterface
{
  public function getAllSubscriptions($queries);
  public function getSubscriptionById(int $id);
  public function createSubscription(array $Subscription);
  public function updateSubscription(object $SubscriptionModel, array $Subscription);
  public function destroySubscription(object $SubscriptionModel, int $id);
  public function restoreSubscription(object $SubscriptionModel, int $id);
}
