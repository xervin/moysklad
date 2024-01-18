<?php

namespace App\Services\MoySklad\Helper;

use NumberFormatter;

class CurrencyHelper
{
    public static function format(string $value): string
    {
        $fmt = new NumberFormatter( 'ru_RU', NumberFormatter::CURRENCY );
        $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
        return $fmt->format($value);
    }
}
