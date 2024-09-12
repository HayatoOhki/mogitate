<?php

namespace App\Consts;

class SortOrder
{
    const ORDER_DEFAULT = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const LIST = [
        'default' => self::ORDER_DEFAULT,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
    ];
}