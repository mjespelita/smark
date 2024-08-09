<?php

namespace Smark\Smark;

class Stringer
{
    // Convert a string to CamelCase
    public static function toCamelCase($string) {
        // Convert the entire string to lowercase
        $result = strtolower($string);

        // Use regular expression to find all alphanumeric sequences
        preg_match_all('/[a-zA-Z0-9]+/', $result, $matches);

        // Initialize result string for CamelCase
        $result = '';
        // Iterate through each matched sequence
        foreach ($matches[0] as $match) {
            // Capitalize the first letter of each sequence and append to result
            $result .= ucfirst($match);
        }
        // Return the result in CamelCase format (lowercase first letter)
        return lcfirst($result);
    }

    // Truncate a string to a specified length, appending '...' if truncated
    public static function truncateString($string, $length) {
        // Check if the string length exceeds the specified length
        if (strlen($string) > $length) {
            // Return the truncated string with '...' appended
            return substr($string, 0, $length) . '...';
        }
        // Return the original string if not truncated
        return $string;
    }

    // Sanitize input by removing HTML tags and converting special characters
    public static function sanitizeInput($input) {
        // Convert special characters to HTML entities and remove HTML tags
        return htmlspecialchars(strip_tags($input));
    }

    // Generate a URL-friendly slug from a string
    public static function generateSlug($string) {
        // Convert string to lowercase, trim whitespace, and replace non-alphanumeric characters with dashes
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }
}
