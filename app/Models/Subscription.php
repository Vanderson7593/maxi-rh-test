<?php

namespace App\Models;

use App\Constants\Model as ModelConstants;
use App\Models\User as User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    use HasFactory;

    protected $guarded = [ModelConstants::ID];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
