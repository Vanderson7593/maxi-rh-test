<?php

namespace App\Services;

use App\Repositories\Contracts\CourseRepositoryInterface;

class CourseService
{
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
    return $this->courseRepository->createCourse($course);
  }
}
