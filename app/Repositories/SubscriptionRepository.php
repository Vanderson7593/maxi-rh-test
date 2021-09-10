<?php

namespace App\Repositories;

use App\Constants\Model;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
  protected $entity;

  public function __construct(Subscription $Subscription)
  {
    $this->entity = $Subscription;
  }

  /**
   * Get all Subscriptions
   * @return array
   */
  public function getAllSubscriptions($queries)
  {
    $data = $this->entity->all();
    if (!$data) {
      return null;
    }
    return $data->load(['user', 'courses']);
  }

  /**
   * Get Subscription by ID
   * @param int $id
   * @return object
   */
  public function getSubscriptionById(int $id)
  {
    $data = $this->entity->where('id', $id)->first();
    if (!$data) {
      return null;
    }
    return $data->load(['user', 'courses']);
  }

  /**
   * Create new Subscription
   * @param array $Subscription
   * @return object
   */
  public function createSubscription(array $Subscription)
  {
    return $this->entity->create($Subscription);
  }

  /**
   * Update Subscription
   * @param object $SubscriptionModel
   * @param array $Subscription
   * @return object
   */
  public function updateSubscription(object $SubscriptionModel, array $Subscription)
  {
    return $SubscriptionModel->update($Subscription);
  }

  /**
   * Update Subscription Status
   * @param object $SubscriptionModel
   * @param array $Subscription
   * @return object
   */
  public function updateSubscriptionStatus(object $SubscriptionModel, string $status)
  {
    return $SubscriptionModel->update(['status' => $status]);
  }

  /**
   * Restore Subscription
   * @param object $SubscriptionModel
   * @param int $id
   */
  public function restoreSubscription(object $subscriptionModel, int $id)
  {
    return $subscriptionModel->update([Model::IS_DELETED => false]);
  }

  /**
   * Delete Subscription
   * @param object $SubscriptionModel
   */
  public function destroySubscription(object $subscriptionModel, int $id)
  {
    return $subscriptionModel->update([Model::IS_DELETED => true]);
  }
}
