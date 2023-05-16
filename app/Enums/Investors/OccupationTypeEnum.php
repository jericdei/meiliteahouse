<?php

namespace App\Enums\Investors;

use App\Traits\EnumToArray;

enum OccupationTypeEnum: string
{
    use EnumToArray;

    case Student = 'student';

    case Working = 'working';
}
