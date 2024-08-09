<?php

namespace Smark\Smark;

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

    // Converts a date string to a human-readable format
    public static function humanReadableDate($date) {
        // Format the date as "Month day, Year (Day of the week) hour:minute am/pm"
        return date('F j, Y (l) g:i a', strtotime($date));
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
}
