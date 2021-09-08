<?php

namespace App\Constants;

final class Subscription
{
    public const TABLE_NAME = 'subscriptions';
    public const USER_ID = 'user_id';
    public const TOTAL = 'total';
    public const STATUS = 'status';

    public const STATUS_MAP = ['paid', 'unpaid', 'cancelled'];
}
