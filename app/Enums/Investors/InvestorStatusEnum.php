<?php

namespace App\Enums\Investors;

use App\Traits\EnumToArray;

enum InvestorStatusEnum: string
{
    use EnumToArray;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case BLACKLISTED = 'blacklisted';
}
