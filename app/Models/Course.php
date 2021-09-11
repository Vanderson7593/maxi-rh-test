<?php

namespace App\Models;

use App\Constants\Course as CourseConstants;
use App\Constants\Model as ModelConstants;
use App\Scopes\IsDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{

    use HasFactory;

    protected $fillable = [
        CourseConstants::ID,
        CourseConstants::NAME,
        CourseConstants::DESCRIPTION,
        CourseConstants::VALUE,
        CourseConstants::SUB_END_DATE,
        CourseConstants::SUB_START_DATE,
        CourseConstants::MAX_SUB,
        CourseConstants::FILE,
        ModelConstants::IS_DELETED,
    ];

    protected $guarded = [ModelConstants::ID];

    protected $attributes = [
        CourseConstants::VALUE => 0,
        ModelConstants::IS_DELETED => false,
    ];

    protected static function booted()
    {
        static::addGlobalScope(new IsDeletedScope);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
