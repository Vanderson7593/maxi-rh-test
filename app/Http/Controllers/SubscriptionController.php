<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

  protected $subscriptionService;

  public function __construct(SubscriptionService $SubscriptionService)
  {
    $this->subscriptionService = $SubscriptionService;
  }

  public function index()
  {
    return $this->subscriptionService->getAllSubscriptions();
  }

  public function update(Request $request, $id)
  {
    return $this->subscriptionService->updateSubscription($id, $request->json()->all());
  }

  public function store(Request $request)
  {
    return $this->subscriptionService->makeSubscription($request->json()->all());
  }
}
