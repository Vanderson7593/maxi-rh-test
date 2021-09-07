<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\HTTPHelpers;
use App\Models\Subscription;
use App\Models\Subscripton;
use App\Services\SubscriptonService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

  protected $SubscriptonService;

  // public function __construct(SubscriptonService $SubscriptonService)
  // {
  //   $this->SubscriptonService = $SubscriptonService;
  // }

  public function index()
  {
    return HTTPHelpers::TryCatch(Subscription::all());
  }

  public function store(Request $request)
  {
    return HTTPHelpers::TryCatch(Subscription::create($request->json()->all()));
  }

  // public function show($Subscripton)
  // {
  //   return HTTPHelpers::TryCatch($this->SubscriptonService->getSubscriptonById($Subscripton));
  // }

  // public function store(Request $request)
  // {
  //   return HTTPHelpers::TryCatch($this->SubscriptonService->makeSubscripton($request->json()->all()));
  // }
}
