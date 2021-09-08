<?php

namespace App\Helpers;

class Helpers
{
  static function mergeObjects($objectA, $objectB)
  {
    $new_object = (object)[];

    // Initializing class properties
    foreach ($objectA as $property => $value) {
      $new_object->$property = $value;
    }

    foreach ($objectB as $property => $value) {
      $new_object->$property = $value;
    }

    return $new_object;
  }
}
