<?php

namespace App\Models;

use App\Constants\Model as ModelConstants;
use App\Constants\Subscription as ConstantsSubscription;
use App\Models\User as User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    use HasFactory;

    protected $guarded = [];


    // protected $casts = [
    //     ConstantsSubscription::COURSES => 'array'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
