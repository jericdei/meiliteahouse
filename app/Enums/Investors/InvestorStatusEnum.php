<?php

namespace App\Enums\Investors;

use App\Traits\EnumToArray;

enum InvestorStatusEnum: string
{
    use EnumToArray;

    case Active = 'active';

    case Inactive = 'inactive';

    case Blacklisted = 'blacklisted';
}
