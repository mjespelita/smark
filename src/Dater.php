<?php

namespace Smark\Smark;

/**
 * calculateAge($dob)
 * humanReadableDateWithDayAndTime($date)   // Month day, Year (Day of the week) hour:minute am/pm
 * humanReadableDateWithDay($date)          // Month day, Year (Day of the week)
 * humanReadableDate($date)                 // Month day, Year
 * humanReadableDay($date)                  // Day of the week
 * humanReadableTime($date)                 // hour:minute am/pm
 * humanReadableMonth($date)                // Month word
 * getWeekdays($startDate, $endDate)
 * getDays($startDate, $endDate)
 */

use DateInterval;
use DatePeriod;
use DateTime;

class Dater
{
    // Calculates age based on the provided date of birth
    public static function calculateAge($dob) {
        $birthDate = new DateTime($dob); // Create a DateTime object for the date of birth
        $currentDate = new DateTime(); // Create a DateTime object for the current date

        // Calculate the difference between the current date and the birth date and return the number of years
        return $currentDate->diff($birthDate)->y;
    }

    // Converts a date with day and time string to a human-readable format
    public static function humanReadableDateWithDayAndTime($date) {
        // Format the date as "Month day, Year (Day of the week) hour:minute am/pm"
        return date('F j, Y (l) g:i a', strtotime($date));
    }

    // Converts a date with day string to a human-readable format
    public static function humanReadableDateWithDay($date) {
        // Format the date as "Month day, Year (Day of the week)"
        return date('F j, Y (l)', strtotime($date));
    }

    // Converts a date with day string to a human-readable format
    public static function humanReadableDate($date) {
        // Format the date as "Month day, Year"
        return date('F j, Y', strtotime($date));
    }

    // Converts a day string to a human-readable format
    public static function humanReadableDay($date) {
        // Format the date as "Day of the week"
        return date('l', strtotime($date));
    }

    // Converts a time string to a human-readable format
    public static function humanReadableTime($date) {
        // Format the date or time as "hour:minute am/pm"
        return date('g:i a', strtotime($date));
    }

    // Converts a time string to a human-readable format
    public static function humanReadableMonth($date) {
        // Format the date or time as "Month"
        return date('F', strtotime($date));
    }

    // Gets all weekdays between the start date and end date
    public static function getWeekdays($startDate, $endDate) {
        // Create a DatePeriod object to iterate over each day between the start and end dates
        $period = new DatePeriod(
            new DateTime($startDate), // Start date
            new DateInterval('P1D'), // Interval of 1 day
            new DateTime($endDate) // End date
        );

        $weekdays = []; // Initialize an empty array to store weekdays

        // Iterate through each date in the period
        foreach ($period as $date) {
            // Check if the day is not Saturday (6) or Sunday (7)
            if (!in_array($date->format('N'), [6, 7])) {
                // Add the date in "Y-m-d" format to the weekdays array
                $weekdays[] = $date->format('Y-m-d');
            }
        }

        return $weekdays; // Return the array of weekdays
    }

    // Gets all days between the start date and end date
    public static function getDays($startDate, $endDate) {
        // Create a DatePeriod object to iterate over each day between the start and end dates
        $period = new DatePeriod(
            new DateTime($startDate), // Start date
            new DateInterval('P1D'), // Interval of 1 day
            new DateTime($endDate) // End date
        );

        $weekdays = []; // Initialize an empty array to store weekdays

        // Iterate through each date in the period
        foreach ($period as $date) {
            // Add the date in "Y-m-d" format to the weekdays array
            $weekdays[] = $date->format('Y-m-d');
        }

        return $weekdays; // Return the array of weekdays
    }

    // Returns the number of full days between two dates
    public static function daysBetween($startDate, $endDate) {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        return $end->diff($start)->days;
    }

    // Checks if the given date is a weekend (Saturday or Sunday)
    public static function isWeekend($date) {
        $dayOfWeek = (int)date('N', strtotime($date));
        return ($dayOfWeek >= 6);
    }

    // Returns a human-readable duration from seconds (e.g. 1h 23m 45s)
    public static function humanReadableDuration($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        $result = '';
        if ($hours > 0) $result .= $hours . 'h ';
        if ($minutes > 0) $result .= $minutes . 'm ';
        $result .= $secs . 's';

        return trim($result);
    }

    // Returns the first day of the month for a given date
    public static function firstDayOfMonth($date) {
        return date('Y-m-01', strtotime($date));
    }

    // Returns the last day of the month for a given date
    public static function lastDayOfMonth($date) {
        return date('Y-m-t', strtotime($date));
    }

    // Returns whether the given year is a leap year
    public static function isLeapYear($year) {
        return (($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0);
    }

    // Adds a number of days to a given date and returns the new date
    public static function addDays($date, $days) {
        $dateObj = new DateTime($date);
        $dateObj->modify("+{$days} days");
        return $dateObj->format('Y-m-d');
    }

    // Subtracts a number of days from a given date and returns the new date
    public static function subtractDays($date, $days) {
        $dateObj = new DateTime($date);
        $dateObj->modify("-{$days} days");
        return $dateObj->format('Y-m-d');
    }

    // Gets the relative date and time. Ex: 1 hour ago, 1 day ago
    public static function timeAgo($date) {
        $timestamp = is_numeric($date) ? $date : strtotime($date);
        $diff = time() - $timestamp;

        if ($diff < 60) return 'just now';
        if ($diff < 3600) return floor($diff / 60) . ' minute' . (floor($diff / 60) === 1 ? '' : 's') . ' ago';
        if ($diff < 86400) return floor($diff / 3600) . ' hour' . (floor($diff / 3600) === 1 ? '' : 's') . ' ago';
        if ($diff < 604800) return floor($diff / 86400) . ' day' . (floor($diff / 86400) === 1 ? '' : 's') . ' ago';
        if ($diff < 2592000) return floor($diff / 604800) . ' week' . (floor($diff / 604800) === 1 ? '' : 's') . ' ago';
        if ($diff < 31536000) return floor($diff / 2592000) . ' month' . (floor($diff / 2592000) === 1 ? '' : 's') . ' ago';

        return floor($diff / 31536000) . ' year' . (floor($diff / 31536000) === 1 ? '' : 's') . ' ago';
    }
}
