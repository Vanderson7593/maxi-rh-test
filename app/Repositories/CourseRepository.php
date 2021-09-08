<?php

namespace App\Repositories;

use App\Constants\Model;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface
{
  protected $entity;

  public function __construct(Course $course)
  {
    $this->entity = $course;
  }

  /**
   * Get all Courses
   * @return array
   */
  public function getAllCourses()
  {
    return $this->entity->all();
  }

  /**
   * Get course by ID
   * @param int $id
   * @return object
   */
  public function getCourseById(int $id)
  {
    return $this->entity->where('id', $id)->first();
  }

  public function verifyCoursesIds(array $ids)
  {
    return $this->entity->where('id', $ids)->exists();
  }

  public function sumCoursesIds(array $ids)
  {
    return $this->entity->whereIn('id', $ids)->sum('value');
  }

  /**
   * Create new Course
   * @param array $course
   * @return object
   */
  public function createCourse(array $course)
  {
    return $this->entity->create($course);
  }

  /**
   * Update Course
   * @param object $courseModel
   * @param array $course
   * @return object
   */
  public function updateCourse(object $courseModel, array $course)
  {
    return $courseModel->update($course);
  }
}
