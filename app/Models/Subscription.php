<?php

namespace App\Models;

use App\Constants\Model as ModelConstants;
use App\Constants\Subscription as SubscriptionConstants;
use App\Models\User as User;
use App\Scopes\IsDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Subscription extends Model
{
    use HasFactory;
    use FilterQueryString;

    protected $filters = [
        SubscriptionConstants::STATUS,
        SubscriptionConstants::PERIOD,
        SubscriptionConstants::SUBSCRIBER
    ];

    protected $fillable = [
        SubscriptionConstants::TOTAL,
        SubscriptionConstants::STATUS,
        SubscriptionConstants::PERIOD,
        SubscriptionConstants::USER_ID,
        ModelConstants::IS_DELETED,
    ];

    protected $guarded = [ModelConstants::ID];

    public function subscriber($query, $value)
    {
        return $query->whereRelation('user', 'name', 'like', "%${value}%");
    }

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
