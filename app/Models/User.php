<?php

namespace App\Models;

use App\Constants\Model as ModelConstants;
use App\Constants\User as UserConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var string[]
    //  */
    // protected $fillable = [
    //     UserConstants::NAME,
    //     UserConstants::EMAIL,
    //     UserConstants::PASSWORD,
    //     UserConstants::CATEGORY,
    //     UserConstants::UF,
    //     UserConstants::CPF,
    //     UserConstants::ADDRESS,
    //     UserConstants::COMPANY,
    //     UserConstants::PHONE,
    //     UserConstants::TELEPHONE,
    //     UserConstants::ROLE,
    //     ModelConstants::IS_DELETED,
    // ];

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    protected $guarded = [ModelConstants::ID];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    protected $attributes = [
        ModelConstants::IS_DELETED => false,
        UserConstants::ROLE => UserConstants::ROLES[2],
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
