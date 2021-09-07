<?php

namespace App\Repositories\Contracts;

interface CourseRepositoryInterface
{
  public function getAllCourses();
  public function getAllCoursesByUserId(int $id);
  public function getCourseById(int $id);
  public function createCourse(array $Course);
  public function updateCourse(int $id, array $Course);
  public function destroyCourse(int $id);
}
