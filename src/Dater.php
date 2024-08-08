<?php

namespace Smark\Smark;

use DateInterval;
use DatePeriod;
use DateTime;

class Dater
{
    public static function calculateAge($dob) {
        $birthDate = new DateTime($dob);
        $currentDate = new DateTime();
        return $currentDate->diff($birthDate)->y;
    }

    public static function humanReadableDate($date) {
        return date('F j, Y (l) g:i a', strtotime($date));
    }

    public static function getWeekdays($startDate, $endDate) {
        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'),
            new DateTime($endDate)
        );

        $weekdays = [];
        foreach ($period as $date) {
            if (!in_array($date->format('N'), [6, 7])) {
                $weekdays[] = $date->format('Y-m-d');
            }
        }
        return $weekdays;
    }
}
