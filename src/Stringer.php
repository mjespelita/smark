<?php

namespace Smark\Smark;

class Stringer
{
    public static function toCamelCase($string) {
        $result = strtolower($string);
        preg_match_all('/[a-zA-Z0-9]+/', $result, $matches);
        $result = '';
        foreach ($matches[0] as $match) {
            $result .= ucfirst($match);
        }
        return lcfirst($result);
    }

    public static function truncateString($string, $length) {
        if (strlen($string) > $length) {
            return substr($string, 0, $length) . '...';
        }
        return $string;
    }

    public static function sanitizeInput($input) {
        return htmlspecialchars(strip_tags($input));
    }

    public static function generateSlug($string) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }
}
