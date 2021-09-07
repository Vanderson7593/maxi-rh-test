<?php

namespace App\Http;

use Exception;

final class HTTPHelpers
{

  static function TryCatch($serviceMethod)
  {
    $CONTENT_TYPE = ['Content-Type' => 'application/json'];
    try {
      $data = $serviceMethod;
      return response()->json(['success' => true, 'data' => $data], 200, $CONTENT_TYPE);
    } catch (Exception $err) {
      return response()->json(['error' => true, 'details' => $err], 200, $CONTENT_TYPE);
    }
  }
}
