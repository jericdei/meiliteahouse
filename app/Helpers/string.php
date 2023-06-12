<?php

if (! function_exists('formatCurrency')) {
    function formatCurrency(int|float $amount, string $currency = 'PHP'): string
    {
        return (new NumberFormatter('en_PH', NumberFormatter::CURRENCY))
            ->formatCurrency($amount, $currency);
    }
}
