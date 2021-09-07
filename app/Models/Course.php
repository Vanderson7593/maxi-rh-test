<?php

namespace App\Models;

use App\Constants\Course as ConstantsCourse;
use App\Constants\Model as ConstantsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{

    use HasFactory;

    protected $guarded = [ConstantsModel::ID];

    protected $attributes = [
        ConstantsCourse::VALUE => 0,
        ConstantsModel::IS_DELETED => false,
    ];

    protected $casts = [
        ConstantsCourse::FILES => 'array'
    ];
}
