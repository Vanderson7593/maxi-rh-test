<?php

namespace App\Models;

use App\Constants\Model as ModelConstants;
use App\Constants\User as UserConstants;
use App\Scopes\IsDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;

    protected $fillable = [
        UserConstants::NAME,
        UserConstants::EMAIL,
        UserConstants::CATEGORY,
        UserConstants::UF,
        UserConstants::CPF,
        UserConstants::ADDRESS,
        UserConstants::COMPANY,
        UserConstants::PHONE,
        UserConstants::TELEPHONE,
        UserConstants::ROLE,
        UserConstants::PASSWORD,
        ModelConstants::IS_DELETED,
    ];

    protected $guarded = [ModelConstants::ID];

    protected $attributes = [
        ModelConstants::IS_DELETED => false,
        UserConstants::ROLE => UserConstants::ROLES[2],
    ];

    protected static function booted()
    {
        static::addGlobalScope(new IsDeletedScope);
    }

    protected $hidden = [
        'password',
    ];
}
