<?php

namespace App\Utils;

class Constants
{
    public const FREE_PLAN = 1;
    public const BASIC_PLAN = 2;
    public const KRASHLESS_PLAN = 3;
    public const ADVANCED_PLAN = 4;

    public const PLANS_FILES = [
        self::FREE_PLAN => 'free',
        self::BASIC_PLAN => 'basic',
        self::KRASHLESS_PLAN => 'krashless',
        self::ADVANCED_PLAN => 'advanced',
    ];
}
