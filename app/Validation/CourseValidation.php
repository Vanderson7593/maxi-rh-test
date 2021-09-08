<?php

namespace App\Validation;

use App\Constants\Course;
use Illuminate\Support\Facades\Validator;

class CourseValidation
{

  static function validateCourse()
  {
    return Validator::make(request()->all(), [
      Course::NAME => 'required|string|max:255|',
      Course::DESCRIPTION => 'required|string|max:255|',
      Course::VALUE => 'required|numeric',
      Course::SUB_START_DATE => 'required|date',
      Course::SUB_END_DATE => 'required|date',
      Course::MAX_SUB => 'required|numeric',
      Course::FILE => 'nullable|mimes:pdf,zip,rar,doc,xlsx,docx'
    ]);
  }
}
