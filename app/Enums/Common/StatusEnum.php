<?php

namespace App\Enums\Common;

use App\Traits\EnumToArray;

enum StatusEnum: string
{
    use EnumToArray;

    case PENDING = 'pending';

    case APPROVED = 'approved';

    case DECLINED = 'declined';
}
