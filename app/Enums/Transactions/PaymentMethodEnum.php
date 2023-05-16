<?php

namespace App\Enums\Transactions;

use App\Traits\EnumToArray;

enum PaymentMethodEnum: string
{
    use EnumToArray;

    case BPI = 'bpi';

    case BDO = 'bdo';

    case GCash = 'gcash';

    case Maya = 'maya';
}
