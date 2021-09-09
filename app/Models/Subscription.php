<?php

namespace App\Models;

use App\Constants\Model as ModelConstants;
use App\Constants\Subscription as ConstantsSubscription;
use App\Models\User as User;
use App\Scopes\IsDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new IsDeletedScope);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
