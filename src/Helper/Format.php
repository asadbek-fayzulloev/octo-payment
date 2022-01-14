<?php

namespace Asadbekinha\OctoPayment\Helper;

class Format
{
    /**
     * Converts som to dollar.
     * @param int|string $som soms.
     * @return float som converted to dollar.
     */
    public static function toDollar($coins)
    {
        return 1 * $coins / 100;
    }

    /**
     * Converts dollar to som.
     * @param float $dollar
     * @return int
     */
    public static function toSom($dollar)
    {
        return round(1 * $dollar * 100);
    }


}