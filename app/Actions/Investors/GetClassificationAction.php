<?php

namespace App\Actions\Investors;

use App\Models\Investors\Classification;
use App\Models\Investors\Investor;

class GetClassificationAction
{
    public static function execute(Investor $investor): Classification
    {
        $amount = $investor->investments->sum('amount');

        $classifications = Classification::all(['id', 'total_investment']);

        foreach ($classifications as $item) {
            if ($amount >= $item->total_investment) {
                $classification = $item;
            }
        }

        return $classification;
    }
}
