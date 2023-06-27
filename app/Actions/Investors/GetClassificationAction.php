<?php

namespace App\Actions\Investors;

use App\Models\Investors\Investor;

class getClassificationAction
{
    public static function execute(Investor $investor): int
    {
        $amount = $investor->investments->sum('amount');

        return match (true) {
            $amount <= 1000 => 1,
            $amount > 1000 && $amount <= 5000 => 2,
            $amount > 5000 && $amount <= 7500 => 3,
            $amount > 7500 && $amount <= 10000 => 4,
            $amount > 10000 && $amount <= 25000 => 5,
        };
    }
}
