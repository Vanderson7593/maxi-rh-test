<?php

namespace App\Services;

use App\Constants\ResponseMessages;
use App\Constants\ResponseStatusCode;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Traits\ApiResponser;
use App\Validation\CourseValidation;

class CourseService
{
  use ApiResponser;

  protected $courseRepository;

  public function __construct(CourseRepositoryInterface $courseRepository)
  {
    $this->courseRepository = $courseRepository;
  }

  /**
   * Get all Courses
   * @return array
   */
  public function getAllCourses()
  {
    return $this->courseRepository->getAllCourses();
  }

  /**
   * Get Course by Id
   * @param int $id
   * @return object 
   */
  public function getCourseById(int $id)
  {
    return $this->courseRepository->getCourseById($id);
  }

  /**
   * Create a new Course
   * @param array $course
   * @return object $course
   */
  public function makeCourse(array $course)
  {
    $validator = CourseValidation::validateCourse();

    if ($validator->fails()) {
      return $this->errorResponse($validator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    return $this->courseRepository->createCourse($course);
  }
}
