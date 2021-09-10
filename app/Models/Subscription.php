<?php

namespace App\Models;

use App\Constants\Model as ConstantsModel;
use App\Models\User as User;
use App\Scopes\IsDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Subscription extends Model
{
    use HasFactory;
    use FilterQueryString;

    protected $filters = ['status', 'period', 'subscriber'];

    protected $guarded = [ConstantsModel::ID];

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
