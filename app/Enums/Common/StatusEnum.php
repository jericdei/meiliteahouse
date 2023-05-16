<?php

namespace App\Enums\Common;

use App\Traits\EnumToArray;

enum StatusEnum: string
{
    use EnumToArray;

    case Pending = 'pending';

    case Approved = 'approved';

    case Declined = 'declined';
}
