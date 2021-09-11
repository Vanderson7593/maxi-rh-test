<?php

namespace App\Services;

use App\Constants\ResponseMessages;
use App\Constants\ResponseStatusCode;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Traits\ApiResponser;
use App\Validation\CourseValidation;
use Illuminate\Support\Facades\Storage;

class CourseService
{
  use ApiResponser;

  protected $courseRepository;

  public function __construct(CourseRepositoryInterface $courseRepository)
  {
    $this->courseRepository = $courseRepository;
  }

  public function getAllCourses()
  {
    $courses = $this->courseRepository->getAllCourses();
    return $this->successResponse($courses, null, ResponseStatusCode::SUCCESS);
  }

  public function getCourseById(int $id)
  {
    $course = $this->courseRepository->getCourseById($id);

    if (!$course) {
      return $this->errorResponse(ResponseMessages::COURSE_NOT_FOUND, ResponseStatusCode::NOT_FOUND);
    }

    return $this->successResponse($course, null, ResponseStatusCode::SUCCESS);
  }


  public function uploudFile($file)
  {
    $path = Storage::disk('local')->put('/course-data', $file);

    if (!$path) {
      return $this->errorResponse(ResponseMessages::FILE_UPLOUD_ERROR, ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    return $path;
  }

  public function makeCourse(array $course, $file)
  {
    $validator = CourseValidation::validateCourse();

    if ($validator->fails()) {
      return $this->errorResponse($validator->errors(), ResponseStatusCode::UNPROCESSABLE_ENTITY);
    }

    $data = $validator->validated();

    if ($file) {
      $url = $this->uploudFile($file);
      $tempCourse = ['file' => $url];
      $data = array_merge($validator->validated(), $tempCourse);
    }

    $finalData = $this->courseRepository->createCourse($data);

    return $this->successResponse($finalData, ResponseMessages::COURSE_CREATED, ResponseStatusCode::SUCCESS);
  }
}
