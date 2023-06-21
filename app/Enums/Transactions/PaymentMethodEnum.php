<?php

namespace App\Enums\Transactions;

use App\Traits\EnumToArray;

enum PaymentMethodEnum: string
{
    use EnumToArray;

    case BPI = 'bpi';

    case BDO = 'bdo';

    case GCASH = 'gcash';

    case MAYA = 'maya';

    public function prettify(): string
    {
        return match ($this) {
            self::BPI => 'BPI',
            self::BDO => 'BDO',
            self::GCASH => 'GCash',
            self::MAYA => 'Maya',
        };
    }
}
