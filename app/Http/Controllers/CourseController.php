<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\HTTPHelpers;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{

  protected $courseService;

  public function __construct(CourseService $courseService)
  {
    $this->courseService = $courseService;
  }

  public function index()
  {
    return HTTPHelpers::TryCatch($this->courseService->getAllCourses());
  }

  public function show($Course)
  {
    return HTTPHelpers::TryCatch($this->courseService->getCourseById($Course));
  }

  public function store(Request $request)
  {
    return HTTPHelpers::TryCatch($this->courseService->makeCourse($request->json()->all()));
  }
}
