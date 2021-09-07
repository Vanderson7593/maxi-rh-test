<?php

namespace App\Repositories\Contracts;

interface CourseRepositoryInterface
{
  public function getAllCourses();
  public function getCourseById(int $id);
  public function createCourse(array $course);
  public function updateCourse(object $courseModel, array $course);
}
