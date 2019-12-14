<?php

namespace App\Service\Helpers;

use DateTime;
use InvalidArgumentException;

class DateFactory
{
    /**
     * Create a DateTime object from a date string. Accept BR Date format
     *
     * @param string $date
     * @return DateTime
     * @throws InvalidArgumentException
     */
    public static function create(string $date)
    {
        if (preg_match('/([2][0]\d{2})(\/|-)([0]\d|[1][0-2])(\/|-)([0-2]\d|[3][0-1])/', $date, $matches) === 1) {
            return new DateTime($matches[1] . '-' . $matches[3] . '-' . $matches[5]);
        }

        if (preg_match('/([0-2]\d|[3][0-1])(\/|-)([0]\d|[1][0-2])(\/|-)([2][0]\d{2})/', $date, $matches) === 1) {
            return new DateTime($matches[5] . '-' . $matches[3] . '-' . $matches[1]);
        }

        throw new InvalidArgumentException(sprintf('The date [%s] format is invalid!', $date));
    } 
}